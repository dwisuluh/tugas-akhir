<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\FileKarya;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use QrCode;

class KaryaIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $karyas = KaryaIlmiah::with(['mahasiswa', 'filekarya'])->latest()->get();
        if (Gate::allows('mhs')) {
            $mhsId = Auth::user()->mahasiswa->id;
            $karyas = $karyas->where('mahasiswa_id', $mhsId);
        }
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        $print = 'print-karya-ilmiah';
        return view('karya.index', compact([
            'karyas', 'title', 'link', 'print'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('mhs');
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        return view('karya.create', compact(['title', 'link']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('mhs');
        $rules = [
            'judul' => 'required',
            'tgl_ujian' => 'required',
            'pembimbing' => 'required',
            'file'  => 'required|mimes:pdf'
        ];

        $request->validate($rules);

        $input = [
            'mahasiswa_id' => $request->id_mhs,
            'nim'   => $request->nim,
            'judul' => $request->judul,
            'pembimbing_1' => $request->pembimbing['0'],
            'tgl_ujian' => Carbon::createFromFormat('d/m/Y', $request->tgl_ujian),
        ];

        if (count($request->pembimbing) == 2) {
            $input['pembimbing_1'] = $request->pembimbing['1'];
        }

        KaryaIlmiah::create($input);

        if ($request->hasFile('file')) {
            $uploadPath = public_path('naskah');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'naskah_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();

            $id_karya = KaryaIlmiah::where('mahasiswa_id', $request->id_mhs)->latest()->first();
            if ($file->move($uploadPath, $rename)) {

                FileKarya::create([
                    'karya_ilmiah_id'  => $id_karya->id,
                    'name' => $originalName,
                    'file' => $rename,
                    'extension' => $extension,
                    'size' => $filesize,
                    'mime' => $mime,
                    'jenis_file' => 1,
                ]);
            }
        }
        return redirect('karya-ilmiah')->with('success', 'Penyerahan Naskah Karya Tulis Ilmiah berhasil diajukan...!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function show(KaryaIlmiah $karyaIlmiah)
    {
        $karyaIlmiah['tgl_indo'] = Carbon::parse($karyaIlmiah->tgl_ujian)->translatedFormat('j F Y');
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        $file = 'naskah';
        $karyaIlmiah->load(['mahasiswa', 'filekarya']);
        // $files = $karyaIlmiah->filekarya()->where
        // dd($karyaIlmiah->filekarya->where('jenis_file',1)->first());
        return view('karya.show', compact(['karyaIlmiah', 'title', 'link', 'file']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function edit(KaryaIlmiah $karyaIlmiah)
    {
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        $karyaIlmiah['tgl_ujian'] = Carbon::createFromFormat('Y-m-d', $karyaIlmiah->tgl_ujian)->format('d/m/Y');
        $karyaIlmiah->load(['mahasiswa', 'filekarya']);
        return view('karya.edit', compact(['karyaIlmiah', 'title', 'link']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KaryaIlmiah $karyaIlmiah)
    {
        $input = [];
        if (Gate::allows('admin')) {
            if ($request->status == 2) {
                $input =
                    [
                        'status' => $request->status,
                        'admin' =>   Auth::user()->name,
                        'tgl_surat' => date('Y-m-d'),
                    ];
            }
        }

        $cek = $karyaIlmiah->update($input);

        // dd($cek);

        return redirect('karya-ilmiah')->with('success', 'Pengumpulan Naskah berhasil di proses dan diterima, silahkan cetak surat keterangan..!!');
        $rules = [];

        // $this->destroy($karyaIlmiah->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KaryaIlmiah $karyaIlmiah)
    {
        $karyaIlmiah->update([
            'status' => 4,
            'tgl_surat' => Carbon::now()->format('Y-m-d')
        ]);

        return redirect('karya-ilmiah')->with('danger', 'Data pengajuan berhasil di tolak..!!!');
    }
    public function print(KaryaIlmiah $karyaIlmiah)
    {
        // dd($karyaIlmiah);
        // $pdf = NULL;
        $karyaIlmiah['tgl_ind'] = Carbon::parse($karyaIlmiah->tgl_surat)->translatedFormat('j F Y');
        $karyaIlmiah->load(['mahasiswa']);
        // if ($surat->id_surat == 1) {
        //     $pdf = PDF::loadview('surat.pendahuluan.cetak', compact('surat'))->setPaper('A4');
        // }
        // if ($surat->id_surat == 2) {
        //     $surat['tgl_mulai_ind'] = Carbon::parse($surat->tgl_mulai)->translatedFormat('j F Y');
        //     $surat['tgl_selesai_ind'] = Carbon::parse($surat->tgl_selesai)->translatedFormat('j F Y');
        //     $pdf = PDF::loadview('karya.cetak', compact('surat'))->setPaper('A4');
        // }
        $data =
            'Nama : '.$karyaIlmiah->mahasiswa->name.' | '.
            'Nim : '.$karyaIlmiah->nim.' | '.
            'Pembimbing_1 : '.$karyaIlmiah->pembimbing_1.' | '.
            'Pembimbing-2 : '.$karyaIlmiah->pembimbing_2.' | '.
            'Tanggal_Surat : '.$karyaIlmiah->tgl_surat.' | '.
            'Admin : '.$karyaIlmiah->admin
        ;
        // $data = [
        //     'Nama' => $karyaIlmiah->mahasiswa->name,
        //     'Nim'  => $karyaIlmiah->nim,
        //     'Pembimbing_1' => $karyaIlmiah->pembimbing_1,
        //     'Pembimbing-2' => $karyaIlmiah->pembimbing_2,
        //     'Tanggal_Surat' => $karyaIlmiah->tgl_surat,
        //     'Admin' => $karyaIlmiah->admin,
        // ];
        // dd($karyaIlmiah  );
        // $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate(implode($data)));
        $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate(stripslashes($data)));
        // $qrCode = QrCode::size(200)->generate($karyaIlmiah);
        $pdf = PDF::loadview('karya.cetak',compact(['karyaIlmiah','qrCode']))->setPaper('A4');
        return $pdf->stream('surat_Keterangan_' . $karyaIlmiah->nim . '.pdf');
    }
}
