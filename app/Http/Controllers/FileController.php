<?php

namespace App\Http\Controllers;

use PDF;
use QrCode;
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
        $surat = Surat::with('mahasiswa')->findOrFail($id);
        $pdf = NULL;
        $surat['tgl_ind'] = Carbon::parse($surat->tgl_surat)->translatedFormat('j F Y');
        $data =
            'Nama : ' . $surat->mahasiswa->name . ' | ' .
            'Nim : ' . $surat->nim . ' | ' .
            'Judul : ' . $surat->judul . ' | ' .
            'Tujuan : ' . $surat->tujuan . ' | ' .
            'Tanggal_Surat : ' . $surat->tgl_surat . ' | ' .
            'Admin : ' . $surat->admin;

        $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('Q')->generate(stripslashes($data)));
        if ($surat->id_surat == 1) {
            $pdf = PDF::loadview('surat.pendahuluan.cetak', compact(['surat','qrCode']))->setPaper('A4');
        }
        if ($surat->id_surat == 2) {
            $surat['tgl_mulai_ind'] = Carbon::parse($surat->tgl_mulai)->translatedFormat('j F Y');
            $surat['tgl_selesai_ind'] = Carbon::parse($surat->tgl_selesai)->translatedFormat('j F Y');
            $pdf = PDF::loadview('surat.penelitian.cetak', compact(['surat','qrCode']))->setPaper('A4');
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
