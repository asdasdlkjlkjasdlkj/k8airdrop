<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login.index');
    }

    public function process(Request $request) {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            "password" => 'required',
        ]);

        if(auth()->attempt($validated)) {
            $request->session()->regenerate();
            return redirect('admin/dashboard')->with('message', 'Welcome back admin.');
        }
        
        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('admin/login')->with('message', 'Logout Successful');

    }

}
