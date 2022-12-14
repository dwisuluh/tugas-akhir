<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class KaryaIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $karyas = KaryaIlmiah::with(['mahasiswa', 'files'])->latest()->get();
        if (Gate::allows('mhs')) {
            $mhsId = Auth::user()->mahasiswa->id;
            $karyas = $karyas->where('mahasiswa_id', $mhsId);
        }
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        $print = 'print-karya-ilmiah';
        return view('karya.index', compact([
            'karyas', 'title','link','print'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('mhs');
        $title = 'Karya Ilmiah';
        $link = 'karya-ilmiah';
        return view('karya.create',compact(['title','link']));
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
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function show(KaryaIlmiah $karyaIlmiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function edit(KaryaIlmiah $karyaIlmiah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KaryaIlmiah $karyaIlmiah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KaryaIlmiah $karyaIlmiah)
    {
        //
    }
}
