<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Livewire\Component;
use App\Models\KaryaIlmiah;
use Illuminate\Support\Facades\Auth;

class MahasiswaDashboard extends Component
{
    public $surats;
    public $karyas;
    public function render()
    {
        $mhsId = Auth::User()->mahasiswa->id;
        $this->surats = Surat::with('mahasiswa')->where('mahasiswa_id',$mhsId)->latest()->get();
        $this->karyas = KaryaIlmiah::with('mahasiswa')->where('mahasiswa_id',$mhsId)->latest()->get();
        return view('livewire.mahasiswa-dashboard');
    }
}
