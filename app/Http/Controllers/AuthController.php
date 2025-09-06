<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = User::where('username', $request->username)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        $user->increment('attempt');
        return redirect()->back()->withInput()->with('error', 'Invalid credentials');
    }

    try {
        $token = JWTAuth::fromUser($user);
        $user->update(['last_login' => now(), 'attempt' => 0]);
        session(['jwt_token' => $token]);
        Log::info('Login successful, token: ' . $token); // Debug
        return redirect()->intended(route('users.index'))->with('success', 'Login successful');
    } catch (JWTException $e) {
        Log::error('JWT Exception: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Could not create token');
    }
}

    public function logout(Request $request)
    {
        session()->forget('jwt_token');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
