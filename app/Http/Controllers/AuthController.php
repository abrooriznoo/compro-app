<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function actionLogin(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        User::where('email', $credentials['email'])->first();

        $checkUser = User::where('email', $credentials['email'])->first();


        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin/');
        }

        // Authentication failed...
        if (!$checkUser) {
            // hanya error email yang dikirim
            return back()->withErrors([
                'email' => 'Email Not Registered.',
            ])->withInput();
        }

        if (!Hash::check($credentials['password'], $checkUser->password)) {
            // hanya error password yang dikirim
            return back()->withErrors([
                'password' => "Password Doesn't Match.",
            ])->withInput();
        }
    }

    /**
     * Logout function.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
