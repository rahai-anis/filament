<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AuthController extends Controller
{
    // Registration form view
    public function register()
    {
        return view('auth.register');
    }

    // Handle registration form submission
    public function registerPost(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new customer record
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Authenticate the customer
        Auth::guard('webb')->loginUsingId($customer->id);

        // Redirect to home or dashboard
        return redirect('/home');
    }

    // Login form view
    public function login()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function loginPost(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the customer
        if (Auth::guard('webb')->attempt($credentials)) {
            // Authentication passed
            return redirect('/home');
        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // Logout the customer
    public function logout(Request $request)
    {
        Auth::guard('webb')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
