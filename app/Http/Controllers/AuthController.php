<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->with('loginError', 'Login failed!');
    }
    
    public function register()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        // return redirect('login.index');
        return redirect(route('login.index'))->with(['success' => 'Registration successfull!, Please login']);
    }
    
    public function checkEmail(Request $request)
    {   
        $inputemail = $request->input('email');
        $cekemail = User::where('email', $inputemail)->first();
        if (!empty($cekemail)) {
            $email = 1; //true
        } else {
            $email = 0; //false
        }

        return $email;
    }

    public function checkUsername(Request $request)
    {   
        $inputusername = $request->input('username');
        $cekusername = User::where('username', $inputusername)->first();
        if (!empty($cekusername)) {
            $username = 1; //true
        } else {
            $username = 0; //false
        }

        return $username;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }
}
