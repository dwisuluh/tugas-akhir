<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PendahuluanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('admin')){
            $this->authorize('admin');
            return view('surat.pendahuluan.admin',[
                'data' => Surat::where('status',1)->get()
            ]);
        }
        $mhsId = Auth::user()->mahasiswa->id;
        $surats = Surat::where('mahasiswa_id',$mhsId)->get();
        return view('surat.pendahuluan.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('mhs')){
            return view('surat.pendahuluan.create');
        }else{
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

        return redirect('pendahuluan')->with('success','Pengajuan surat studi pendahuluan berhasil diajukan...!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        return view('surat.pendahuluan.print',[
            'data' => Surat::findOrFail($id)
        ]);
    }
}
