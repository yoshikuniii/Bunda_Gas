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
        return redirect()->to('dashboard')->with('success', 'Data updated successfully!');
    }
}
