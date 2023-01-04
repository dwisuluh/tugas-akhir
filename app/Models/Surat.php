<?php

namespace App\Models;

// use App\Models\Files;
// use App\Models\Mahasiswa;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function files()
    {
        return $this->hasOne(Files::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search) {
            return $query->where('nim', 'like', '%' . $search . '%')
                ->orWhere('tujuan', 'like', '%' . $search . '%')
                ->orWhereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });
    }
}
