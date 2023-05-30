<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $data = $response->json();
        $token = $data['token'];
        session(['token' => $token]);
        $token = session('token');
        if ($token==0) {
            session()->forget('token');
            return redirect()->route('login')->with('error', 'Hatalı Giriş Tekrar Deneyin!');
        }
        return redirect()->route('home2')->with('message', 'GİRİŞ BASARILI');
    }

    public function register(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $data = $response->json();
        
        return redirect()->route('login')->with('message', 'KAYIT BASARILI');
    }

    public function logout()
    {
        $token = session('token');
        
        if (!empty($token)) {
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/admin/logout');
            
            if ($response->successful()) {
                session()->forget('token');
                session()->forget('username');
            }
        }
        
        return redirect('/home')->with('message', 'ÇIKIŞ BASARILI');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }
    public function showHomeForm()
    {
        return view('home');
    }
    public function showHome2Form()
    {
        return view('home2');
    }
}




