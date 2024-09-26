<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('login', [ 'title' => 'Login']);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'someText' => ['required', 'string' ,'min:3'],
            'password' => ['required',],
        ]);

        $identifier = $credentials['someText'];
        $password = $credentials['password'];
    
        // Determine if the identifier is an email or username
        $fieldType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('dashboard');
        // }

        if (Auth::attempt([$fieldType => $identifier, 'password' => $password])) {
            $request->session()->regenerate();
    
            return redirect()->intended('dashboard');
        }
 
        return back()->with([
            'error' => 'There was an error with your login. Please check your credentials and try again.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        if ($request->isMethod('get')) {
            return redirect('/dashboard');
        }

        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        
        return redirect('/');

    }





}
