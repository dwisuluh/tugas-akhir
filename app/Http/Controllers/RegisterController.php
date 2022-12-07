<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;

class RegisterController extends Controller
{

    protected $string = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    public function __construct()
    {
        $this->password = substr(str_shuffle($this->string), 0, 8);
    }
    public function index()
    {
        return view('login.register');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('nim', $request['nim'])->first();
        $rules =[
            'nim'   => ['required', 'string', 'unique:users,username', 'exists:mahasiswas,nim'],
            // 'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users','unique:mahasiswas'],
        ];
        if($request->email != $mahasiswa->email)
        {
            $rules['email'] = ['required', 'string', 'email:dns', 'max:255', 'unique:users','unique:mahasiswas'];
        }
        $request->validate($rules);
        $send = [
            'greeting'  => 'Hi, Selamat Datang, ' . $mahasiswa['name'],
            'body'      => 'Terima kasih telah melakukan resgitrasi akun. <br>' .
                'untuk melakukan login silahkan menggunakan username dan password sebagai berikut: <br>' .
                '<strong>Username : </strong>' . $request['nim'] . '<br>' .
                '<strong>Password : </strong>' . $this->password . '<br>',
            'actionText'    => 'Link Aplikasi',
            'action'        => url('/'),
            'thanks'        => 'jangan lupa untuk melakukan mengganti password setelah melakukan login ke aplikasi.'
        ];

        User::create([
            'username' => $request['nim'],
            'name' => $mahasiswa['name'],
            'email' => $request['email'],
            'password' => Hash::make($this->password),
        ]);
        $userid = User::where('username', $request['nim'])->first();
        $mahasiswa->update([
            'user_id'   => $userid['id'],
            'email'     => $request['email'],
            'status'    => true
        ]);

        Notification::route('mail', $request['email'])->notify(new EmailNotification($send));

        return redirect('/login')->with('success', ' aktivasi berhasil, silahkan cek email untuk memgetahui username dan password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'nim' => ['required', 'string', 'exists:users,username']
        ]);
        User::where('username', $request['nim'])->update([
            'password' => Hash::make($this->password)
        ]);

        $userid = User::where('username', $request['nim'])->first();
        $send = [
            'greeting'  => 'Hi, ' . $userid['name'],
            'body'      => 'Anda telah melakukan reset password. <br>' .
                'untuk melakukan login silahkan menggunakan username dan password sebagai berikut: <br>' .
                '<strong>Username : </strong>' . $userid['username'] . '<br>' .
                '<strong>Password : </strong>' . $this->password . '<br>',
            'actionText'    => 'Link Aplikasi',
            'action'        => url('/'),
            'thanks'        => 'jangan lupa untuk melakukan mengganti password setelah melakukan login ke aplikasi.'
        ];
        Notification::route('mail', $userid['email'])->notify(new EmailNotification($send));
        return redirect('/login')->with('success', ' reset password berhasil, silahkan cek email untuk memgetahui password terbaru');
    }
}
