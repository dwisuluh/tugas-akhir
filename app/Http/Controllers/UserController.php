<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('user.create');
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
            'username'  => ['required','string','unique:users,username'],
            'name'      => ['required','string'],
            'email'     => ['required','string','email:dns','unique:users,email'],
            'role'      => ['required'],
            'password'  => ['required','confirmed','min:8']
        ]);

        User::create([
            'username'  => $request->username,
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'password'  => Hash::make($request->password)
        ]);
        // dd('sukses');

        return redirect(route ('user.index'))->with('success','Data user berhasil ditambahkan ...!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = User::find(Crypt::decryptString($id));
        return view('user.edit', compact('find'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'oldPassword' => 'required',
            'password'  => 'required|confirmed|min:8',
        ]);

        $userId = User::find(Crypt::decryptString($id));

        if(!Hash::check($request->oldPassword, $userId->password))
        {
            return back()->with('passError', 'Unable to Change Password');
        }

        User::where('id',$userId->id)->update([
            'password'  => Hash::make($request->password)
         ]);

        return redirect('/')->with('success', ' reset password berhasil, silahkan cek email untuk memgetahui password terbaru');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('user')->with('success','Data berhasil dihapus..!!!');
    }
}
