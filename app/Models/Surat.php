<?php

namespace App\Models;

use App\Models\Files;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function Files()
    {
        return $this->hasOne(Files::class);
    }
}
