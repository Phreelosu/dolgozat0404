<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

    public function getUserProfileData() {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }

    public function setUserProfileData(Request $request) {
        $user = Auth::user();
        $user->update($request->all());
        return response()->json(['message' => 'Profile data updated successfully', 'user' => $user]);
    }

    public function setNewPassword(Request $request) {
        $request->validate([
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function deleteAccount() {
        $user = Auth::user();
        $user->delete();
        return response()->json(['message' => 'Account deleted successfully']);
    }
}
