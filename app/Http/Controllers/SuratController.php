<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->surat = Surat::all();
        $this->surat = Surat::with('mahasiswa')->latest()->get();
    }
    public function index(Request $id_surat)
    {
        $id = $id_surat->id;
        $surats = $this->surat->where('id_surat',$id);
        // dd($surats);
        // $surats = Surat::with('mahasiswa')->where('status',$id)->get();
        // $surats = $this->surat->where('status', $id);
        if (Gate::allows('mhs')) {
            $mhs_id = Auth::User()->mahasiswa->id;
            // $surats = $surats->load(['mahasiswa' => function($query){
            //     $query->where('mahasiswa_id','mhs_id');
            // }]);
            // $surats = Surat::where(['mahasiswa_id' => $mhs_id,
            // 'id_surat' => $id])->latest()->get();
            $surats = $surats->where('mahasiswa_id',$mhs_id);
        }
        // if(Gate::allows('admin')){
        //     $surats = Surat::where('id_surat',$id)->latest()->get();
        // }
        // dd($surats);
        $title = ($id == 1) ? 'Studi Pendahuluan' : 'Penelitian';
        return view('surat.index', compact([
            'surats', 'title','id'
        ]));
        // dd($id_surat);
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
    public function create(Request $id_surat)
    {
        $type = $id_surat->id;
        if (Gate::allows('mhs')) {
            return view('surat.create', compact('type'));
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
        $mahasiswa = Auth::user()->mahasiswa;
        $rules = [
            'tujuan'    => 'required',
            'alamat'    => 'required',
            'judul'     => 'required',
        ];
        $input = [
            'mahasiswa_id' => $mahasiswa->id,
            'nim'       => $mahasiswa->nim,
            'tujuan'    => $request->tujuan,
            'alamat'    => $request->alamat,
            'judul'     => $request->judul,
            'id_surat'  => $request->id_surat
        ];
        if ($request->id_surat == 2) {
            $rules['lokasi'] = 'required';
            $rules['tgl_awal'] = 'required';
            $rules['tgl_akhir'] = 'required';

            $input['lokasi'] = $request->lokasi;
            $input['tgl_mulai'] = $request->tgl_awal;
            $input['tgl_selesai'] = $request->tgl_akhir;
        }
        $request->validate($rules);
        // dd($rules);
        Surat::create($input);
        // dd($input);
        $id = $request->id_surat;
        return redirect('surat.index',['id' => $id])->with('success', 'Pengajuan surat studi pendahuluan berhasil diajukan...!!');

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
        $surat->load('mahasiswa');
        // dd($surat->mahasiswa->name);
        return view('surat.edit', compact('surat'));
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
