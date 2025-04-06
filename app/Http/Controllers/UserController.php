<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WorkOSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginAuth(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        if (Auth::attempt($validate)) {
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Invalid Email',
                'password' => 'Incorrect Password'
            ]);
        }
    }

    public function logout(Request $request){
        $request::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(route('login'))->with('Logout has been successfully done');
    }
}
