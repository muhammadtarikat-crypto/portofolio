<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // POST /api/contacts : simpan pesan dari form kontak ke MySQL
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|min:3|max:150',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Message::create($data);

        return response()->json(['message' => 'Terima kasih! Pesan Anda sudah tersimpan.'], 201);
    }
}
