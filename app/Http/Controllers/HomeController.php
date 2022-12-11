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
    public function index()
    {
        if (Gate::allows('admin')) {
            return view('home.dashboard.home', [
                'count' => Mahasiswa::count(),
                'surat' => Surat::where('status', 1)->get(),
                'karya' => KaryaIlmiah::count()
            ]);
        } else {
            $mhsId = Auth::user()->mahasiswa->id;
            $surat = Surat::where('mahasiswa_id', $mhsId)->orderBy('tgl_surat','desc')->get();
            return view('home.mahasiswa.index',compact('surat'));
        }
    }
    public function observasi()
    {

    }
    public function penelitian()
    {

    }
    public function karyaIlmiah()
    {

    }
}
