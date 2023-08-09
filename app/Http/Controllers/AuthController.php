<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegistRequest $request)
    {
        try {
            $data = $request->validated();
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return response()->json(['message' => 'berhasil, silahkan login'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'ooppss'], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            if(! auth()->attempt($data)){
                return response()->json([
                    'errors' => ['email' => ['Email or password wrong']]
                ], 400);
            }

            $user = User::where('email', $data['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'berhasil login', 'token' => $token], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'logout success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'ooppss'], 500);
        }
    }
}
