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
    }
    public function index()
    {
        $surats = Surat::with('mahasiswa')->get();
        $karyas = KaryaIlmiah::with('mahasiswa')->get();
        $countMhs = NULL;
        // dd($surats);
        if (Gate::allows('admin')) {
            $surats = $surats->where('status', 1);
            $karyas = $karyas->where('status', 1);
            $countMhs = Mahasiswa::count();
        }
        if (Gate::allows('mhs')) {
            $mhsId = Auth::User()->mahasiswa->id;
            $surats = $surats->where('mahasiswa_id',$mhsId);
            $karyas = $karyas->where('mahasiswa_id',$mhsId);
        }
        return view('home.dashboard.home', compact([
            'countMhs', 'karyas', 'surats'
        ]));
    }
}
