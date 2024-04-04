<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    
    public function register(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|unique:users|max:255',
        'password' => 'required|string|confirmed|min:6',
    ]);

    // Create a new user instance
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    // Return a response indicating success
    return response()->json([
        'message' => 'Sikeres regisztráció',
        'user' => $user,
    ], 201);
}

    public function login(Request $request)
        {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication successful
            $authUser = Auth::user();
            $token = $authUser->createToken($authUser->username . "token")->plainTextToken;
        
            return response()->json([
                'message' => 'Sikeres azonosítás',
                'user' => $authUser,
                'token' => $token,
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'message' => 'Sikertelen azonosítás. Hibás felhasználónév vagy jelszó.',
            ], 401);
        }
    }


    public function logout( Request $request ) {

        auth( "sanctum" )->user()->currentAccessToken()->delete();

        return response()->json([ "message" => "Sikeres kijelentkezés" ]);
    }
}
