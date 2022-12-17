<?php

namespace App\Models;

// use App\Models\KaryaIlmiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileKarya extends Model
{
    use HasFactory,HasUuids;

    protected $guarded = ['id'];

    public function karyaIlmiah()
    {
        return $this->belongsTo(KaryaIlmiah::class);
    }
}
