<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Log the user in and issue an access token using Sanctum.
     * 
     * Data validation is made with \App\Http\Requests\AuthenticateRequest;
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(AuthenticateRequest $request): JsonResponse
    {
        // Verify only email and password were sent from client
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authenticate user
            $user = Auth::user();

            // Generate user token with Sanctum
            $token = $user->createToken('Todo App')->plainTextToken;

            // Success Response
            return response()->json([
                'message' => 'User logged in successfully',
                'success' => true,
                'user' => $user,
                'access_token' => $token,
            ]);
        }

        // Failed Response
        return response()->json([
            'message' => 'The provided email and password do not match our records.',
            'success' => false,
        ], 401);
    }

    /**
     * Register the user and issue an access token using Sanctum.
     * 
     * Data validation is made with \App\Http\Requests\RegisterRequest;
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // Create new user
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash the password
        ]);
    
        // Store user
        $user->save();
    
        // Generate user token
        $token = $user->createToken('Todo App')->plainTextToken;
    
        // Success Response
        return response()->json([
            'message' => 'User registered successfully',
            'success' => true,
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }

    /**
     * Log the user out and revoke their access token using Sanctum.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Get user
        $user = $request->user();

        // If user exists destroy token
        if ($user) {
            $user->tokens()->delete(); // Revoke all user's tokens
        }

        // Success Response
        return response()->json([
            'message' => 'User logged out successfully',
            'success' => true,
        ]);
    }
}