<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function update(Request $request)
    {
        Session::flash('name', $request->name);
        // Session::flash('email', $request->email);

        $request->validate([
            'name'=>'required',
            // 'email'=>'required|email',
        ],[
            // message control
        ]);

        $data = [
            'name'=> $request->name,
            // 'email' => $request->email,
        ];

        User::where('id', Auth::user()->id)->update($data);
        return redirect()->to('user')->with('success', 'Data updated successfully!');
    }

    public function changePassword()
    {
        return view('user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed'
        ]);

        # check apakah password yang dimaksukan pada form 'current_password'
        # sama dengan password yang ada di database. Kalo sama, update passwordnya.

        $password_check = Hash::check(
            $request->current_password,
            Auth::user()->password
        );

        if ($password_check) { # if true
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->to('user')->with('success','Password berhasil diganti.');

        } else {
            return redirect()->to('user')->withErrors('Password lama yang Anda masukan tidak sesuai dengan database.');
        }
    }
}
