<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim'   => $row[0],
            'name'  => $row[1],
            'jenis_kelamin' => $row[2],
            'program_studi' => $row[3],
        ]);
    }
}
