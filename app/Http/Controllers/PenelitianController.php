<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Files;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->surat = Surat::where('id_surat', 2)->with(['mahasiswa', 'files'])->latest()->get();
    }

    public function index()
    {
        $surats = Surat::where('id_surat', 2)->with(['mahasiswa', 'files'])->latest()->get();
        if (Gate::allows('mhs')) {
            $mhsId = Auth::user()->mahasiswa->id;
            $surats = $surats->where('mahasiswa_id', $mhsId);
        }
        $title = 'Penelitian';
        $link = 'surat-penelitian';
        $print = 'print-penelitian';
        return view('surat.index', compact([
            'surats', 'title', 'link', 'print'
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
        $title = 'Penelitian';
        $link = 'surat-penelitian';
        return view('surat.create', compact(['title', 'link']));
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
        $mahasiswa = Auth::user()->mahasiswa;
        $rules = [
            'tujuan'    => 'required',
            'alamat'    => 'required',
            'judul'     => 'required',
            'lokasi'    => 'required',
            'tgl_mulai'  => 'required',
            'tgl_selesai' => 'required'
        ];
        $request->validate($rules);
        Surat::create([
            'mahasiswa_id' => $mahasiswa->id,
            'nim'       => $mahasiswa->nim,
            'tujuan'    => $request->tujuan,
            'alamat'    => $request->alamat,
            'judul'     => $request->judul,
            'lokasi'    => $request->lokasi,
            'tgl_mulai' => Carbon::createFromFormat('d/m/Y', $request->tgl_mulai),
            'tgl_selesai' => Carbon::createFromFormat('d/m/Y', $request->tgl_selesai),
            'id_surat'  => 2
        ]);
        return redirect('surat-penelitian')->with('success', 'Pengajuan surat Ijin Penelitian berhasil diajukan...!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        $tgl = Carbon::parse($surat->tgl_surat)->translatedFormat('j F Y');
        $surat['tgl_indo'] = $tgl;
        // $surat['tahun'] = Carbon::;
        $title = 'Penelitian';
        $link = 'surat-penelitian';
        $fileSurat = 'penelitian';
        $surat->load(['mahasiswa', 'files']);
        return view('surat.show', compact(['surat', 'title', 'link', 'fileSurat']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        $surat->load(['mahasiswa', 'files']);
        $surat['tgl_mulai'] = Carbon::createFromFormat('Y-m-d', $surat->tgl_mulai)->format('d/m/Y');
        $surat['tgl_selesai'] = Carbon::createFromFormat('Y-m-d', $surat->tgl_selesai)->format('d/m/Y');
        $title = 'Penelitian';
        $link = 'surat-penelitian';
        return view('surat.edit', compact(['surat', 'title', 'link']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        $surat->load(['mahasiswa', 'files']);
        $rules = [];
        if ($request->status == 2) {
            $rules = [
                'noSurat' => 'required',
                'tglSurat' => 'required'
            ];
            if (Carbon::createFromFormat('d/m/Y', $request->tgl_mulai) != $surat->tgl_mulai && $request->status == 2) {
                $rules['tgl_mulai'] = ['required'];
            }
            if (Carbon::createFromFormat('d/m/Y', $request->tgl_selesai) != $surat->tgl_selesai && $request->status == 2) {
                $rules['tgl_selesai'] = ['required'];
            }
        }
        if ($request->tujuan != $surat->tujuan && $request->status == 2) {
            $rules['tujuan'] = ['required'];
        }
        if ($request->alamat != $surat->alamat && $request->status == 2) {
            $rules['alamat'] = ['required'];
        }
        if ($request->judul != $surat->judul && $request->status == 2) {
            $rules['judul'] = ['required'];
        }
        if ($request->lokasi != $surat->lokasi && $request->status == 2) {
            $rules['lokasi'] = ['required'];
        }
        if ($request->status == 3) {
            $rules['file'] = ['required', 'mimes:pdf'];
        }
        $request->validate($rules);
        if ($request->status == 2) {
            $surat->update([
                'tujuan'    => $request->tujuan,
                'alamat'    => $request->alamat,
                'judul'     => $request->judul,
                'no_surat'  => $request->noSurat,
                'tgl_surat' => Carbon::createFromFormat('d/m/Y', $request->tglSurat),
                'status'    => $request->status,
                'tgl_mulai' => Carbon::createFromFormat('d/m/Y', $request->tgl_mulai),
                'tgl_selesai' => Carbon::createFromFormat('d/m/Y', $request->tgl_selesai),
                'lokasi'    => $request->lokasi,
                'admin'     => Auth::user()->name

            ]);
        }
        if ($request->status == 3) {

            if ($request->hasFile('file')) {
                $uploadPath = public_path('penelitian');
                if (!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }

                $file = $request->file('file');
                $explode = explode('.', $file->getClientOriginalName());
                $originalName = $explode[0];
                $extension = $file->getClientOriginalExtension();
                $rename = 'peneltian_' . date('YmdHis') . '.' . $extension;
                $mime = $file->getClientMimeType();
                $filesize = $file->getSize();

                if ($file->move($uploadPath, $rename)) {
                    Files::create([
                        'surat_id'  => $surat->id,
                        'name' => $originalName,
                        'file' => $rename,
                        'extension' => $extension,
                        'size' => $filesize,
                        'mime' => $mime,
                    ]);
                }
            }
            $surat->update([
                'status'    => $request->status,
            ]);
            $send = [
                'subject'   => 'Surat Permohonan Ijin Penelitian',
                'greeting'  => 'Hi, ' . $surat->mahasiswa['name'],
                'body'      => 'Surat Permohonan Ijin Penelitian telah selesai. <br>' .
                    'Silahkan Masuk ke aplikasi dan surat ijin dapat di download melalui tombol print ataupun detail <br>',
                'actionText'    => 'Link Aplikasi',
                'action'        => url('/'),
                'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
            ];
            Notification::route('mail', $surat->mahasiswa['email'])->notify(new EmailNotification($send));
        }
        if ($request->status == 4) {
            $surat->update([
                'tgl_surat' => $request->tanggal,
                'status' => $request->status,
                'admin'  => Auth::user()->name
            ]);
            $send = [
                'subject'   => 'Surat Permohonan Ijin Penelitian',
                'greeting'  => 'Hi, ' . $surat->mahasiswa['name'],
                'body'      => 'Surat Permohonan Ijin Penelitian anda <strong>Ditolak</strong>. <br>' .
                    'Silahkan Masuk ke aplikasi untuk mengajukan kembali surat ijin Penelitian. <br>',
                'actionText'    => 'Link Aplikasi',
                'action'        => url('/'),
                'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
            ];
            Notification::route('mail', $surat->mahasiswa['email'])->notify(new EmailNotification($send));
            return redirect('surat-penelitian')->with('failed', 'Surat Pengajuan Ijin Penelitian di Tolak');
        }
        return redirect('surat-penelitian')->with('success', 'Surat berhasil diproses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        //
    }
    public function print(Surat $surat)
    {
        $surat->load(['files', 'mahasiswa']);
        $lokasi = 'penelitian/';
        return view('surat.print', compact(['surat', 'lokasi']));
    }
}
