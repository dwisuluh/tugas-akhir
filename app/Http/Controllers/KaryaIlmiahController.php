<?php

namespace App\Http\Controllers;

use PDF;
use QrCode;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\FileKarya;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

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
        $dosens = Dosen::all();
        return view('karya.create', compact(['title', 'link', 'dosens']));
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
            'pembimbing1' => 'required',
            'file'  => 'required|mimes:pdf'
        ];

        $request->validate($rules);

        $input = [
            'mahasiswa_id' => $request->id_mhs,
            'nim'   => $request->nim,
            'judul' => $request->judul,
            'pembimbing_1' => $request->pembimbing1,
            'tgl_ujian' => Carbon::createFromFormat('d/m/Y', $request->tgl_ujian),
        ];

        if ($request->pembimbing2) {
            $input['pembimbing_2'] = $request->pembimbing2;
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
        $print = 'print-karya-ilmiah';
        $karyaIlmiah->load(['mahasiswa', 'filekarya']);

        return view('karya.show', compact(['karyaIlmiah', 'title', 'link', 'file', 'print']));
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
        $dosens = Dosen::all();
        if (Gate::allows('admin')) {
            return view('karya.adminEdit', compact(['karyaIlmiah', 'title', 'link']));
        }
        return view('karya.edit', compact(['karyaIlmiah', 'title', 'link', 'dosens']));
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
        $catatan = NULL;
        if (Gate::allows('mhs')) {
            $rules = [
                'judul' => 'required',
                'tgl_ujian' => 'required',
                'pembimbing1' => 'required',
            ];

            $request->validate($rules);

            $input = [
                'nim'   => $request->nim,
                'judul' => $request->judul,
                'pembimbing_1' => $request->pembimbing1,
                'pembimbing_2' => NULL,
                'tgl_ujian' => Carbon::createFromFormat('d/m/Y', $request->tgl_ujian),
            ];

            if ($request->pembimbing2) {
                $input['pembimbing_2'] = $request->pembimbing2;
            }

            $karyaIlmiah->update($input);

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

                if ($file->move($uploadPath, $rename)) {

                    $karyaIlmiah->filekarya()->update([
                        'name' => $originalName,
                        'file' => $rename,
                        'extension' => $extension,
                        'size' => $filesize,
                        'mime' => $mime,
                    ]);
                }
            }
        }
        if (Gate::allows('admin')) {
            if ($request->status == 2) {
                $input =
                    [
                        'status' => $request->status,
                        'admin' =>   Auth::user()->name,
                        'tgl_surat' => date('Y-m-d'),
                    ];
                $catatan = 'Pengumpulan Naskah berhasil di proses dan diterima, silahkan cetak surat keterangan..!!';
            }
            if ($request->status == 3) {
                $request->validate([
                    'file' => ['required', 'mimes:pdf']
                ]);
                $input = ['status' => $request->status];

                if ($request->hasFile('file')) {
                    $uploadPath = public_path('naskah');
                    if (!File::isDirectory($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true, true);
                    }

                    $file = $request->file('file');
                    $explode = explode('.', $file->getClientOriginalName());
                    $originalName = $explode[0];
                    $extension = $file->getClientOriginalExtension();
                    $rename = 'surat_keterangan_' . date('YmdHis') . '.' . $extension;
                    $mime = $file->getClientMimeType();
                    $filesize = $file->getSize();

                    if ($file->move($uploadPath, $rename)) {

                        FileKarya::create([
                            'karya_ilmiah_id'  => $karyaIlmiah->id,
                            'name' => $originalName,
                            'file' => $rename,
                            'extension' => $extension,
                            'size' => $filesize,
                            'mime' => $mime,
                            'jenis_file' => 2,
                        ]);
                    }
                }
                $catatan = 'Upload surat keterangan telah berhasil diproses...!!!';

                $karyaIlmiah->load('mahasiswa');
                $send = [
                    'subject'   => 'Penyerahan Naskah Karya Tulis Ilmiah',
                    'greeting'  => 'Hi, ' . $karyaIlmiah->mahasiswa['name'],
                    'body'      => 'Penyerahan Naskah Karya Tulis Ilmiah anda <strong>diterima</strong>. <br>' .
                        'Silahkan Masuk ke aplikasi dan surat keterangan dapat didownload. <br>',
                    'actionText'    => 'Link Aplikasi',
                    'action'        => url('/'),
                    'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
                ];
                Notification::route('mail', $karyaIlmiah->mahasiswa['email'])->notify(new EmailNotification($send));
            }
        }

        $cek = $karyaIlmiah->update($input);

        return redirect('karya-ilmiah')->with('success', $catatan);

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

        $karyaIlmiah->load('mahasiswa');
        $send = [
            'subject'   => 'Penyerahan Naskah Karya Tulis Ilmiah',
            'greeting'  => 'Hi, ' . $karyaIlmiah->mahasiswa['name'],
            'body'      => 'Penyerahan Naskah Karya Tulis Ilmiah anda <strong>ditolak</strong>. <br>' .
                'Silahkan Masuk ke aplikasi dan upload kembali Naskah Kaya Tulis Ilmiah sesuai dengan ketentuan dan format yang berlaku. <br>',
            'actionText'    => 'Link Aplikasi',
            'action'        => url('/'),
            'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
        ];
        Notification::route('mail', $karyaIlmiah->mahasiswa['email'])->notify(new EmailNotification($send));

        return redirect('karya-ilmiah')->with('danger', 'Data pengajuan berhasil di tolak..!!!');
    }
    public function print(KaryaIlmiah $karyaIlmiah)
    {

        $karyaIlmiah['tgl_ind'] = Carbon::parse($karyaIlmiah->tgl_surat)->translatedFormat('j F Y');
        $karyaIlmiah->load(['mahasiswa']);

        $data =
            'Nama : ' . $karyaIlmiah->mahasiswa->name . ' | ' .
            'Nim : ' . $karyaIlmiah->nim . ' | ' .
            'Pembimbing_1 : ' . $karyaIlmiah->pembimbing_1 . ' | ' .
            'Pembimbing-2 : ' . $karyaIlmiah->pembimbing_2 . ' | ' .
            'Tanggal_Surat : ' . $karyaIlmiah->tgl_surat . ' | ' .
            'Admin : ' . $karyaIlmiah->admin;

        // $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate(implode($data)));
        $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate(stripslashes($data)));
        // $qrCode = QrCode::size(200)->generate($karyaIlmiah);
        $pdf = PDF::loadview('karya.cetak', compact(['karyaIlmiah', 'qrCode']))->setPaper('A4');
        return $pdf->stream('surat_Keterangan_' . $karyaIlmiah->nim . '.pdf');
    }

    public function download(KaryaIlmiah $karyaIlmiah)
    {
        dd($karyaIlmiah);
        $karyaIlmiah->load(['mahasiswa', 'filekarya']);
        $lokasi = 'naskah/';
        return view('karya.download-surat', compact(['karyaIlmiah', 'lokasi']));
    }
}
