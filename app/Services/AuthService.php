<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interface\AuthInterface;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService implements AuthInterface
{

    public function login($request): object
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);

        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);

    }

    public function register($request): object
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }
}
