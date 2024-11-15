<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Api extends Controller
{
    public function getToken(): JsonResponse
    {
        return response()->json([
            'token' => csrf_token(),
        ]);
    }

    public function registration(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'gender' => 'required|string|in:m,f',
        ]);

        User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'gender' => $validated['gender']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created',
        ], 201);
    }

    public function profile(Request $request): JsonResponse
    {
        $user = User::find($request->id);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'User not found'
        ], 404);
    }

}
