<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function viewPageRegister() {
        return view('usersRegister');
    }

    public function sendUserData(Request $request) {
        $request->validate([
            'firstName' => 'accepted',
            'lastName' => 'accepted',
            'fullName' => 'accepted',
            'birth' => 'accepted',
            'email' => 'filled',
            'password' => 'filled'
        ]);

        $password = $request['password'];

        User::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'fullName' => $request['fullName'],
            'birth' => $request['birth'],
            'email' => $request['email'],
            'password' => Hash::make($password,['rounds' => 15]),
        ]);

        if($password==null || $password=='') {
            return redirect('/users/register')->with('error', 'Password cannot be empty!');
        }
        return redirect('/users/login')->with('success', 'User registered successfully!');
    }
}
