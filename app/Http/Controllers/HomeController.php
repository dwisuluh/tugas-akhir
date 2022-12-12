<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Mahasiswa;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->surat = Surat::all();
        $this->karya = KaryaIlmiah::all();
    }
    public function index()
    {
        $surats = $this->surat;
        $karyas = $this->karya;
        $countMhs = Mahasiswa::all()->count();

        if (Gate::allows('admin')) {
            $surats = $surats->where('status', 1);
            $karyas = $karyas->where('status', 1);
        }
        if (Gate::allows('mhs')) {
            $mhsId = Auth::User()->mahasiswa->id;
            $surats = $surats->where('mahasiswa_id', $mhsId);
            $karyas = $karyas->where('mahasiswa_id', $mhsId);
        }
        return view('home.dashboard.home', compact([
            'countMhs', 'karyas', 'surats'
        ]));
        // if (Gate::allows('admin')) {
        //     return view('home.dashboard.home', [
        //         'count' => $this->surat->count(),
        //         'surat' => $this->surat->where('status', 1),
        //         'karya' => $this->karya->count()
        //     ]);
        // } else {
        //     // $mhsId = Auth::user()->mahasiswa->id;
        //     // dd($this->user);
        //     // $surat = Surat::where('mahasiswa_id', $this->user)->orderBy('tgl_surat', 'desc')->get();
        //     $surat = $this->surat->where('mahasiswa_id', Auth::User()->mahasiswa->id);
        //     return view('home.mahasiswa.index', compact('surat'));
        // }
    }
    public function observasi()
    {
        $surats = $this->surat->where('id_surat', 1);
        if (Gate::allows('mhs')) {
            $surats = $surats->where('mahasiswa_id', Auth::User()->mahasiswa->id);
        }
        $title = 'Studi Pendahuluan';
        return view('surat.index', compact([
            'surats','title']));
    }
    public function penelitian()
    {
        $surats = $this->surat->where('id_surat', 2);
        if (Gate::allows('mhs')) {
            // $surats = $this->surat->where('mahasiswa_id',Auth::User()->mahasiswa->id)->where('id_surat',2);
            $surats = $surats->where('mahasiswa_id', Auth::User()->mahasiswa->id);
        }
        $title = 'Penelitian';
        return view('surat.index', compact(['surats','title']));
    }
    public function karyaIlmiah()
    {
    }
}
