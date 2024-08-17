<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        $users = Http::get('https://f0b5-118-99-123-32.ngrok-free.app/api/v1/auth/user');

        return view('auth.login', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showregister()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function authLogin()
    {
        try {
            $response = Http::post(env("API_BASE_URL") . '/auth/login', [
                'email' => request('email'),
                'password' => request('password')
            ]);
            $user = $response->json();

            $userData = ApiResponseHelper::extractData($user);

            return redirect()->route('dashboard-admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
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
