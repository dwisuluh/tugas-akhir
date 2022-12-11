<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileKarya extends Model
{
    use HasFactory,HasUuids;

    protected $guarded = ['id'];

    public function karyaIlmiah()
    {
        return $this->belongsTo(KaryaIlmiah::class);
    }
}
