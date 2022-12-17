<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     'username'  => 'dwisp',
        //     'name'      => 'Dwi Suluh Pribadi',
        //     'email'     => 'dwisuluh@uny.ac.id',
        //     'password'  => Hash::make('danendra'),
        //     'role'      => true
        // ]);
        \App\Models\Dosen::create([
            ['nama' => 'Ibnu Mardiyoko, S.KM., MM.'],
            ['nama' => 'Hendra Rohman, S.KM. M.P.H.'],
            ['nama' => 'Syarah Mazaya F., S.KM., M.P.H'],
            ['nama' => 'Vidya Widowati, S.KM., M.A.R.S'],
            ['nama' => 'Yuli Fitriyah, S.KM., M.P.H.'],
            ['nama' => 'Agung Dwi Saputro, S.KM., M.A.R.S'],
            ['nama' => 'Andhy Sulistyo, M.Kom.'],
            ['nama' => 'dr. Anna Dewi Lukitasari, M.P.H.'],
            ['nama' => 'Indra Narendra, M.H.Kes.'],
            ['nama' => 'M. Imron Mawardi, M.Kes (Epid)'],
            ['nama' => 'Sugeng, S.KM., MM'],
            ['nama' => 'Ana Mardiyaningsih, M.Sc., Apt'],
            ['nama' => 'Eddy Kristiyono, S.KM.'],
            ['nama' => 'Fadia Sulaiman, S.Thi., M.Si'],
            ['nama' => 'Nur Ismiyati, M.Sc., Apt'],
            ['nama' => 'Oni Noviandi K., S.Pd., M.Pd'],
            ['nama' => 'Pramono, S.Kom'],
            ['nama' => 'Widhi Sulistyo, S.Kom. M.Cs.'],
            ['nama' => 'Windadari Murni Hartini, M.P.H.'],
        ]);
    }
}
