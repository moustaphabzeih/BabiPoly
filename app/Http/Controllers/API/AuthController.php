<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        try {
            \Log::info('Registration attempt started');
            
            // ENHANCED VALIDATION RULES
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:255',
                    'confirmed',
                ],
                'password_confirmation' => 'required|string'
            ], [
                // CUSTOM ERROR MESSAGES
                'name.required' => 'The full name is required.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]);

            \Log::info('Validation passed');
            
            // Simple user creation
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            \Log::info('User created: ' . $user->id);
            
            // Simple token creation
            $token = $user->createToken('auth_token')->plainTextToken;
            
            \Log::info('Token created');

            return response()->json([
                'message' => 'User registered successfully',
                'user_id' => $user->id,
                'token' => $token
            ], 201);
            
        } catch (ValidationException $e) {
            // ADDED: Specific validation error handling
            \Log::error('Registration validation error: ' . json_encode($e->errors()));
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            \Log::info('Login attempt started');
            
            // Validate login credentials
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            \Log::info('Login validation passed');
            
            // Attempt to authenticate the user
            if (!Auth::attempt($request->only('email', 'password'))) {
                \Log::warning('Login failed: Invalid credentials for ' . $request->email);
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Get the authenticated user
            $user = User::where('email', $request->email)->first();
            \Log::info('Login successful for user: ' . $user->id);
            
            // Create new token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return success response
            return response()->json([
                'message' => 'Login successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ]);

        } catch (ValidationException $e) {
            \Log::error('Login validation error: ' . json_encode($e->errors()));
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}