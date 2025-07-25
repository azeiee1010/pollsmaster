<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // expects password_confirmation field
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate access token
        $tokenResult = $user->createToken('PollsMasterToken');

        return response()->json([
            'status'        => true,
            'message'       => 'User registered successfully',
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
        ], 201);
    }

    /**
     * Login an existing user
     */
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken('PollsMasterToken');
        return response()->json([
            'status'        => true,
            'message'       => 'Login successful',
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
        ], 200);
    }

    /**
     * Logout the user (optional)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status'  => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function getUser(Request $request)
    {
        return response()->json([
            'message' => 'User retrieved successfully',
            'user' => $request->user()
        ], 200);
    }
}
