<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        $token = session('token');
        return $token;
    }

    public function index()
    {
        $token = session('token');
        if ($token) {
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/posts');
            if ($response->successful()) {
                $yol = $response->json();
                return view('index', compact('yol'));
            } else {
                return redirect()->route('index')->with('error', 'Gönderiler yüklenirken bir hata oluştu.');
            }
        } else {
            return redirect()->route('home')->with('error', 'Token yok!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showStoreForm()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = session('token');
        if (!$token) {
            return response()->json(['error' => 'Token yok']);
        }
    
        try {
            $response = Http::withToken($token)
                ->post('http://127.0.0.1:8000/api/store', [
                    'name' => $request->input('name'),
                    'mail' => $request->input('mail'),
                    'explanation' => $request->input('explanation')
                ]);
    
            if ($response->successful()) {
                return redirect()->route('index')->with('message', 'Gönderi başarıyla eklendi.');
            } else {
                $errorMessage = $response->json()['error'] ?? 'Unknown error occurred.';
                return redirect()->route('index')->with('error', 'Gönderi eklenirken bir hata oluştu: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'İstek sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            $token = session('token');
            
            $response = Http::withToken($token)->delete('http://127.0.0.1:8000/api/posts/' . $id);
            
            if ($response->successful()) {
                return redirect()->route('index')->with('error', 'SİLME BAŞARILI .');

            } else {
                return response()->json([
                    'error' => 'An error occurred during the request'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred during the request'
            ]);
        }
    }
    
    public function edit($id)
    {
        $token = session('token');
        if (!$token) {
            return redirect()->route('index')->with('error', 'Token yok!');
        }

        try {
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/posts/' . $id);
            if ($response->successful()) {
                $post = $response->json();
                return view('edit', compact('post'));
            } else {
                return redirect()->route('index')->with('error', 'Gönderi bulunamadı.');
            }
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Gönderi yüklenirken bir hata oluştu.');
        }
    }

    public function update(Request $request, $id)
    {
        $token = session('token');
        if (!$token) {
            return response()->json(['error' => 'Token not found']);
        }

        try {
            $response = Http::withToken($token)->put('http://127.0.0.1:8000/api/posts/' . $id, [
                'name' => $request->input('name'),
                'mail' => $request->input('mail'),
                'explanation' => $request->input('explanation')
            ]);

            $post = $response->json();

            return redirect()->route('index')->with('message', 'Gönderi Güncellendi.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during the request']);
        }
    }
    public function show($id)
    {
        $token = session('token');
        if (!$token) {
            return redirect()->route('index')->with('error', 'Token yok!');
        }
    
        try {
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/posts/' . $id);
            if ($response->successful()) {
                $post = $response->json(); // Gönderi verilerini al
                return view('show', compact('post'));
            } else {
                return redirect()->route('index')->with('error', 'Gönderi bulunamadı.');
            }
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Gönderi yüklenirken bir hata oluştu.');
        }
    }
    
}
