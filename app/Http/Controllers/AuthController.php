<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->back();
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            session([
                'username' => $request->username,
                'password' => $request->password,
                'role' => $user->role,
                'name' => $user->name,
            ]);
            return redirect()->intended('home');
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors(['Invalid credentials']);
    }

    public function logout(Request $request)
    {
        try {
            session()->flush();
            Auth::guard('web')->logout();

            return redirect()->route('login');
        } catch (Exception $e) {
            report($e);

            return redirect()->route('login');
        }
    }
}
