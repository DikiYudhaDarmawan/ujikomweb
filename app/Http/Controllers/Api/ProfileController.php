<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
}