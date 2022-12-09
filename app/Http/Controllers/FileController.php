<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Files;
use App\Models\Surat;
use Illuminate\Http\Request;
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
        $pdf = PDF::loadview('surat.pendahuluan.cetak', compact('surat'))->setPaper('A4');
        // $pdf = PDF::loadHTML('surat.pendahuluan.cetak')->setPaper('a4', 'potrait')->setWarnings(false)->save('myfile.pdf');
        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('surat.pendahuluan.cetak');
    	// return $pdf->download('surat_cetak.pdf');
    	// return $pdf->render('surat_'.$surat->nim.'.pdf');
    	return $pdf->stream('surat_'.$surat->nim.'.pdf');
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
