<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HelloWorldController extends Controller
{
    public function ambilFile()
    {
        return view('ambilfile');
    }

    public function kirimPesan(Request $request)
    {
        $userMessage = $request->input('message');

        if (empty($userMessage)) {
            return response()->json(['error' => 'Pesan tidak boleh kosong'], 400);
        }

        try {
            // Panggil API Langflow dari server Laravel (PHP)
            $response = Http::withHeaders([
                'x-api-key' => 'sk-gePOFEZfnf_tpgRV8p3F8-HXmyIWFoDngBfLPLT4OJA', // Ganti dengan API Key Langflow Anda
                'Content-Type' => 'application/json',
            ])->timeout(120)->post('http://127.0.0.1:7860/api/v1/run/5bbd480f-d738-4dd6-bb53-5d9cb04ec601', [
                'input_value' => $userMessage,
                'input_type' => 'chat',
                'output_type' => 'chat',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Ambil hasil teks balasan dari struktur data JSON Langflow
                $reply = $data['outputs'][0]['outputs'][0]['results']['message']['text'] 
                        ?? 'Maaf, tidak ada respon dari AI.';

                return response()->json([
                    'status' => 'success',
                    'reply' => $reply
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal terhubung ke Langflow (HTTP ' . $response->status() . ')'
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}