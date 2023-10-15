<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->withErrors(['password' => 'Admin is not found']);
        } else {
            if (Hash::check($request->password, $admin->password)) {
                Auth::login($admin);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['password' => 'Password is incorrect']);
            }
        }
    }
}
