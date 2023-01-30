<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\KaryaIlmiah;

class AdminDashboard extends Component
{
    public $surats;
    public $karyas;
    public $countMhs;

    public function render()
    {
        $this->surats = Surat::whereHas('mahasiswa', function ($query){
            $query->where('status',true);
        })->where('status',1)->latest()->get();
        $this->karyas = KaryaIlmiah::with('mahasiswa')->where('status',1)->latest()->get();
        $this->countMhs = Mahasiswa::count();
        return view('livewire.admin-dashboard');
    }
}
