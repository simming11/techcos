<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
   // User login
   public function login(Request $request)
   {
       $fields = $request->validate([
           'name' => 'required|string',
           'password' => 'required|string',
       ]);

       // Check name
       $user = User::where('name', $fields['name'])->first();

       if (!$user) {
           return response([
               'message' => 'Invalid Login: User not found'
           ], 401);
       }
       // Check password
       if (!Hash::check($fields['password'], $user->password)) {
           return response([
               'message' => 'Invalid Login: Incorrect password'
           ], 401);
       }

       // Delete old tokens
       $user->tokens()->delete();

       // Create new token
       $token = $user->createToken($request->userAgent(), [$user->role])->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];

       return response($response, 200);
   }
   
 // User logout
   public function logout(Request $request)
   {
       // Delete the current access token
       $request->user()->currentAccessToken()->delete();

       // Response after logout
       return response([
           'message' => 'Logged Out',
       ], 200);
   }
}
