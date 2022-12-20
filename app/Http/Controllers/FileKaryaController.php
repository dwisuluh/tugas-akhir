<?php

namespace App\Http\Controllers;

use App\Models\FileKarya;
use Illuminate\Http\Request;

class FileKaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileKarya  $fileKarya
     * @return \Illuminate\Http\Response
     */
    public function show(FileKarya $fileKarya)
    {
        // dd($fileKarya);
        $fileKarya->load('karyaIlmiah');
        $lokasi = 'naskah/';
        return view('karya.download-surat',compact(['fileKarya','lokasi']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileKarya  $fileKarya
     * @return \Illuminate\Http\Response
     */
    public function edit(FileKarya $fileKarya)
    {
        dd($fileKarya);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileKarya  $fileKarya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileKarya $fileKarya)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileKarya  $fileKarya
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileKarya $fileKarya)
    {
        //
    }
}
