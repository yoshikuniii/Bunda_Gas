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

    public function edit($id) 
    {
        $data = User::where('id', $id)->first();
        return view('user.index')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        Session::flash('email', $request->email);
        Session::flash('name', $request->name);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ],[
            // message control
        ]);

        $data = [
            'name'=> $request->name,
            'email' => $request->email,
        ];

        User::where('id', $id)->update($data);
        return redirect()->to('dashboard')->with('success', 'Data updated successfully!');
    }
}
