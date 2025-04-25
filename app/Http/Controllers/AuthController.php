<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengembalikan tampilan app.blade yang isinya form login
        return view('index');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek user dan password
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Login user

            // Redirect berdasarkan role
            if ($user->role == 1) {
                return redirect('app');
            } elseif ($user->role == 2) {   
                return redirect('/');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput();

    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        return redirect('/'); // Redirect ke halaman login
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
