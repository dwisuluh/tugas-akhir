<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        // if (Gate::allows('admin')) {
        //     $this->authorize('admin');
        //     return view('surat.penelitian.admin', [
        //         'data' => Surat::where('id_surat')->latest()->get()
        //     ]);
        // }
        // $surats = Surat::where([
        //     ['mahasiswa_id', Auth::user()->mahasiswa->id],
        // ])->latest()->get();
        // dd($surats);
        // return view('surat.penelitian.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('mhs')) {
            return view('surat.penelitian.create');
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
        $this->authorize('mhs');
        $request->validate([
            'tujuan'    => 'required',
            'alamat'    => 'required',
            'judul'     => 'required',
            'lokasi'    => 'required',
            'tgl_awal'  => 'required',
            'tgl_akhir' => 'required'
        ]);
        $mahasiswa = Auth::user()->mahasiswa;
        Surat::create([
            'mahasiswa_id' => $mahasiswa->id,
            'nim'       => $mahasiswa->nim,
            'tujuan'    => $request->tujuan,
            'alamat'    => $request->alamat,
            'judul'     => $request->judul,
            'lokasi'    => $request->lokasi,
            'tgl_mulai'  => $request->tgl_awal,
            'tgl_selesai' => $request->tgl_akhir,
            'id_surat'  => 2
        ]);
        // dd($input);
        return redirect('penelitian')->with('success', 'Pengajuan surat studi pendahuluan berhasil diajukan...!!');

        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        // $surat = Surat::findOrFail($surat);
        // dd($surat->mahasiswa_id);
        // $surats = $surat;
        // $surat->load('Mahasiswa');
        // dd($surat->mahasiswa->name);
        return view('surat.penelitian.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        //
    }
}
