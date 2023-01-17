<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index() {
        return view("session/index");
    }

    function login(Request $request) {
        Session::flash('email', $request->email);

        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ],[
            // message control
        ]);

        $login_info = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($login_info)) { // if user login success
            return redirect('dashboard')->with('success','Login berhasil');
        } else {
            return redirect('login')->withErrors('Email or password incorrect');
        }
    }

    function logout() {
        Auth::logout();
        return redirect('/login');
    }

    function register() {
        return view('session/register');
    }

    function create(Request $request) {
        Session::flash('email', $request->email);
        Session::flash('name', $request->name);
        Session::flash('alamat', $request->alamat);
        Session::flash('nomor_telepon', $request->nomor_telepon);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'alamat'=>'required',
            'nomor_telepon'=>'required'
        ],[
            // message control
        ]);

        $data = [
            'name'=> $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'role' => 'staff',
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
