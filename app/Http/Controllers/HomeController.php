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
        $surats = Surat::with('mahasiswa')->latest()->get();
        $karyas = KaryaIlmiah::with('mahasiswa')->latest()->get();
        $countMhs = NULL;
        $dashboard = NULL;

        if (Gate::allows('admin')) {
            $surats = $surats->where('status', 1);
            $karyas = $karyas->where('status', 1);
            $countMhs = Mahasiswa::count();
            $dashboard = 'home.dashboard.home';
        }
        if (Gate::allows('mhs')) {
            $mhsId = Auth::User()->mahasiswa->id;
            $surats = $surats->where('mahasiswa_id',$mhsId);
            $karyas = $karyas->where('mahasiswa_id',$mhsId);
            $dashboard = 'home.mahasiswa.home';
        }
        return view($dashboard, compact([
            'countMhs', 'karyas', 'surats'
        ]));
    }
}
