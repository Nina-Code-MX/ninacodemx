<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginControllerV1 extends Controller
{
    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $loginUserData['email'])->first();

        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // $token = $user->tokens->where('name', 'api-token')->first();
        $token = $user->createToken('api-token', ['portfolios:*', 'services:*', 'teams:*', 'users:*']);
        
        return response()->json(['message' => 'Successfully logged in.', 'token' => $token->plainTextToken], 200);
    }
}
