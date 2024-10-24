<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    // Register a new user
     public function register(Request $request)
     {
         // Validate the request
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         // Create the user
         $user = User::create([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'password' => Hash::make($validated['password']),
         ]);
 
         // Automatically log the user in after registration
         Auth::login($user);
         return redirect()->intended('/users');
         return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
     }
 
     // Login an existing user
     public function login(Request $request)
     {
        
         // Validate the login request
         $validated = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
        
         // Attempt to log the user in
         if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
             $user = Auth::user();
             return redirect()->intended('/users');
             // return response()->json(['message' => 'Login successful', 'user' => $user], 200);
         }
 
         // If login attempt failed, throw an error
         throw ValidationException::withMessages([
             'email' => ['The provided credentials are incorrect.'],
         ]);
     }
 
     // Logout the user
     public function logout(Request $request)
     {
         Auth::logout();
         return redirect()->intended('/login');
         return response()->json(['message' => 'Logged out successfully'], 200);
     }

}
