<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Surat;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $surat = NULL;

        if(request('search')){
            $surat = Surat::latest()->filter(request(['search','mahasiswa']))->where('status',3)->get();
        }
        return view('search.index',compact('surat'));
    }
    public function show($id){

        $data = Surat::with('mahasiswa')->findOrFail($id);
        $data['tgl_surat'] = Carbon::parse($data->tgl_surat)->translatedFormat('j F Y');
        $data['tgl_mulai'] = Carbon::parse($data->tgl_mulai)->translatedFormat('j F Y');
        $data['tgl_selesai'] = Carbon::parse($data->tgl_selesai)->translatedFormat('j F Y');

        return view('search.show',compact('data'));

    }
}
