<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;
use Carbon\Carbon;

class PendahuluanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $this->authorize('admin');
            return view('surat.pendahuluan.admin', [
                'data' => Surat::where('id_surat', 1)->latest()->get()
            ]);
        }
        $mhsId = Auth::user()->mahasiswa->id;
        $surats = Surat::where('mahasiswa_id', $mhsId)->get();
        return view('surat.pendahuluan.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('mhs')) {
            return view('surat.pendahuluan.create');
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
            'alamat' => 'required',
            'judul' => 'required'
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        Surat::create([
            'mahasiswa_id' => $mahasiswa->id,
            'nim' => $mahasiswa->nim,
            'tujuan' => $request->tujuan,
            'alamat' => $request->alamat,
            'judul' => $request->judul,
            'surat_id' => 1
        ]);

        return redirect('pendahuluan')->with('success', 'Pengajuan surat studi pendahuluan berhasil diajukan...!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Surat::findOrFail($id);
        $tgl = Carbon::parse($data->tgl_surat)->format('j F Y');
        $data['tgl_indo'] = $tgl;
        // dd($data);
        return view('surat.pendahuluan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin');
        $data = Surat::findOrFail($id);
        return view('surat.pendahuluan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $rules = [];
        // dd($surat->mahasiswa['email']);
        if ($request->status == 2) {
            $rules = [
                'noSurat' => 'required',
                'tglSurat' => 'required|date'
            ];
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
        if ($request->status == 3) {
            $rules['file'] = ['required', 'mimes:pdf'];
        }
        $request->validate($rules);
        // dd($id);
        // dd($surat);
        if ($request->status == 3) {
            // $surat->update([
            //     'tujuan'    => $request->tujuan,
            //     'alamat'    => $request->alamat,
            //     'judul'     => $request->judul,
            //     'no_surat'  => $request->noSurat,
            //     'tgl_surat' => $request->tglSurat,
            //     'status'    => $request->status,
            //     'admin'     => Auth::user()->name,
            //     'file'      => $request->file

            // ]);
            // return Route::('files.store',$request);
            // dd($id);
            if ($request->hasFile('file')) {
                $uploadPath = public_path('pendahuluan');
                if (!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }

                $file = $request->file('file');
                $explode = explode('.', $file->getClientOriginalName());
                $originalName = $explode[0];
                $extension = $file->getClientOriginalExtension();
                $rename = 'stupen_' . date('YmdHis') . '.' . $extension;
                $mime = $file->getClientMimeType();
                $filesize = $file->getSize();

                if ($file->move($uploadPath, $rename)) {
                    Files::create([
                        'surat_id'  => $id,
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
                'subject'   => 'Surat Permohonan Ijin Studi Pendahuluan',
                'greeting'  => 'Hi, ' . $surat->mahasiswa['name'],
                'body'      => 'Surat Permohonan Ijin Studi Pendahuluan telah selesai. <br>' .
                    'Silahkan Masuk ke aplikasi dan surat ijin dapat di download melalui tombol print ataupun detail <br>',
                'actionText'    => 'Link Aplikasi',
                'action'        => url('/'),
                'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
            ];
            Notification::route('mail', $surat->mahasiswa['email'])->notify(new EmailNotification($send));
        }
        if ($request->status == 2) {
            $surat->update([
                'tujuan'    => $request->tujuan,
                'alamat'    => $request->alamat,
                'judul'     => $request->judul,
                'no_surat'  => $request->noSurat,
                'tgl_surat' => $request->tglSurat,
                'status'    => $request->status,
                'admin'     => Auth::user()->name

            ]);
        }
        if ($request->status == 4) {
            $surat->update([
                'tgl_surat' => $request->tanggal,
                'status' => $request->status,
                'admin'  => Auth::user()->name
            ]);
            $send = [
                'subject'   => 'Surat Permohonan Ijin Studi Pendahuluan',
                'greeting'  => 'Hi, ' . $surat->mahasiswa['name'],
                'body'      => 'Surat Permohonan Ijin Studi Pendahuluan anda <strong>Ditolak</strong>. <br>' .
                    'Silahkan Masuk ke aplikasi untuk mengajukan kembali surat ijin Studi Pendahuluan. <br>',
                'actionText'    => 'Link Aplikasi',
                'action'        => url('/'),
                'thanks'        => 'Atas perhatian dan kerjasama yang baik diucapkan terima kasih'
            ];
            Notification::route('mail', $surat->mahasiswa['email'])->notify(new EmailNotification($send));
            return redirect('pendahuluan')->with('failed','Surat Pengajuan dibatalkan');
        }
        return redirect('pendahuluan')->with('success', 'Surat berhasil diproses');
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($id)
    {
        return view('surat.pendahuluan.print', [
            'data' => Surat::findOrFail($id)
        ]);
    }
}
