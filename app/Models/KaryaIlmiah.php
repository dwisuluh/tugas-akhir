<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaIlmiah extends Model
{
    use HasFactory, HasUuids;

    protected $guarded=['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function filekarya()
    {
        return $this->hasMany(FileKarya::class);
    }
}
