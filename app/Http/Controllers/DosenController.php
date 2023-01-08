<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Imports\ImportDosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->authorize('admin');
    }

    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('dosen.create');
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
            'nama' => 'required',
        ]);
        Dosen::create([
            'nama' => $request->nama,
        ]);
        return redirect('data-dosen')->with('success', 'Input data dosen berhasil....');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::find($id);

        return view('dosen.edit', compact('dosen'));
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
        $request->validate([
            'nama' => 'required',
        ]);

        $dosen = Dosen::find($id);
        $dosen->update($request->all());

        return redirect('data-dosen')->with('success', 'Update data dosen berhasil...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dosen::find($id)->delete();

        return redirect('data-dosen')->with('danger', 'Data Dosen berhasil dihapus...');
    }

    public function import()
    {
        return view('dosen.upload');
    }
    public function importData(Request $data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $path = $data->file('file');

        Excel::import(new ImportDosen, $path);

        return redirect('data-dosen')->with('success', 'Import Data Mahasiswa Berhasil');
    }
}
