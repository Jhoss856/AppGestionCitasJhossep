<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Método para iniciar sesión (Login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario con las credenciales básicas de Laravel
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Protege contra ataques de fijación de sesión

            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user()
            ], 200);
        }

        // Si las credenciales no coinciden
        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    // Método para cerrar sesión (Logout)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Regenera el token CSRF por seguridad

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}