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
        // Validate input with custom messages
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // expects password_confirmation field
        ], [
            // Custom error messages
            'name.required' => 'Full name is required.',
            'name.string' => 'Name must be a valid text.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered. Please use a different email or try logging in.',

            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a valid text.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.confirmed' => 'Password confirmation does not match. Please make sure both password fields are identical.',
        ]);

        if ($validator->fails()) {
            // Get the first error message for better UX
            $firstError = $validator->errors()->first();

            return response()->json([
                'status'  => false,
                'message' => $firstError, // Single clear message
                'errors'  => $validator->errors(), // All errors for debugging
            ], 422);
        }

        try {
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
                'message'       => 'Registration successful! Welcome to PollsMaster.',
                'access_token'  => $tokenResult->accessToken,
                'token_type'    => 'Bearer',
                'user'          => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Registration failed due to server error. Please try again later.',
                'errors'  => ['server' => ['An unexpected error occurred.']]
            ], 500);
        }
    }

    /**
     * Login an existing user
     */
    public function login(Request $request)
    {
        // Validate input with custom messages
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            // Custom error messages
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a valid text.',
        ]);

        if ($validator->fails()) {
            // Get the first error message for better UX
            $firstError = $validator->errors()->first();

            return response()->json([
                'status'  => false,
                'message' => $firstError, // Single clear message
                'errors'  => $validator->errors(), // All errors for debugging
            ], 422);
        }

        try {
            // Check if user exists first
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No account found with this email address. Please check your email or register for a new account.',
                    'errors'  => ['email' => ['User not found.']]
                ], 401);
            }

            // Attempt login
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Incorrect password. Please check your password and try again.',
                    'errors'  => ['password' => ['Invalid password.']]
                ], 401);
            }

            $user = Auth::user();
            $tokenResult = $user->createToken('PollsMasterToken');

            return response()->json([
                'status'        => true,
                'message'       => 'Login successful! Welcome back to PollsMaster.',
                'access_token'  => $tokenResult->accessToken,
                'token_type'    => 'Bearer',
                'user'          => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Login failed due to server error. Please try again later.',
                'errors'  => ['server' => ['An unexpected error occurred.']]
            ], 500);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

            return response()->json([
                'status'  => true,
                'message' => 'Successfully logged out. See you again soon!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Logout failed. Please try again.',
                'errors'  => ['server' => ['An unexpected error occurred.']]
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        return response()->json([
            'message' => 'User retrieved successfully',
            'user' => $request->user()
        ], 200);
    }
}
