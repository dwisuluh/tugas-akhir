<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Files;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat.pendahuluan.cetak');
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        $pdf = NULL;
        $surat['tgl_ind'] = Carbon::parse($surat->tgl_surat)->translatedFormat('j F Y');
        if ($surat->id_surat == 1) {
            $pdf = PDF::loadview('surat.pendahuluan.cetak', compact('surat'))->setPaper('A4');
        }
        if ($surat->id_surat == 2) {
            $pdf = PDF::loadview('surat.penelitian.cetak', compact('surat'))->setPaper('A4');
        }
        return $pdf->stream('surat_' . $surat->nim . '.pdf');
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
}
