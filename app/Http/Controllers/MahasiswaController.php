<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $this->authorize('admin');
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'       => ['required', 'string', 'unique:mahasiswas,nim'],
            'name'      => ['required', 'string'],
            'email'     => ['required', 'string', 'email:dns', 'unique:mahasiswas,email', 'unique:users,email'],
            'jenis_kelamin'      => ['required'],
            'prodi'  => ['required']
        ]);

        Mahasiswa::create([
            'nim'       => $request->nim,
            'name'      => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'program_studi' => $request->prodi,
            'email'     => $request->email,
        ]);

        return redirect('mahasiswa')->with('succces', 'Data Mahasiswa berhasil ditambahkan...!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $this->authorize('admin');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($mahasiswa)
    {
        $mahasiswa = Mahasiswa::findOrFail(Crypt::decryptString($mahasiswa));

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'name' => ['required', 'string'],
            'jenis_kelamin' => ['required'],
            'prodi' => ['required']
        ];
        if ($request->nim != $mahasiswa->nim) {
            $rules['nim'] = ['required', 'string', 'exists:mahasiswas,nim'];
        }
        if ($request->email != $mahasiswa->email) {
            $rules['email'] = ['required', 'string', 'email:dns', 'unique:mahasiswas,email', 'unique:users,email'];
        }
        $request->validate($rules);

        $mahasiswa->update([
            'nim'       => $request->nim,
            'name'      => $request->name,
            'email'     => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'program_studi'  => $request->prodi
        ]);
        return redirect('mahasiswa')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
