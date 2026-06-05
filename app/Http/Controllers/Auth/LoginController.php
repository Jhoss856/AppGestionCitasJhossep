<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // =========================================================================
    // OAUTH: GOOGLE
    // =========================================================================

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGoogleCallBack()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password'  => bcrypt(uniqid()),
                ]
            );

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error al iniciar sesión con Google');
        }
    }

    // =========================================================================
    // OAUTH: GITHUB (Corregido y optimizado con Eloquent)
    // =========================================================================

    public function redirectToGithub()
    {
        // Se eliminó el 'prompt' ya que GitHub no lo soporta en su API de autenticación
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallBack()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            // Obtenemos el ID de GitHub de forma segura
            $githubId = $githubUser->getId() ?? $githubUser->user['id'] ?? null;

            if (!$githubId) {
                throw new \Exception("No se pudo obtener el identificador único de GitHub.");
            }

            // Buscamos directamente con el Modelo User para mantener la consistencia
            $user = User::where('github_id', $githubId)->first();

            if (!$user) {
                // Si no existe por ID, creamos un correo alternativo por si viene oculto
                $email = $githubUser->getEmail() ?? ($githubUser->getNickname() ?? uniqid()) . '@github.com';

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name'      => $githubUser->getName() ?? $githubUser->getNickname() ?? 'Usuario GitHub',
                        'github_id' => $githubId,
                        'password'  => bcrypt(uniqid()),
                    ]
                );
            } else {
                // Si ya existe, actualizamos su información de perfil local
                $user->update([
                    'name'  => $githubUser->getName() ?? $githubUser->getNickname() ?? $user->name,
                    'email' => $githubUser->getEmail() ?? $user->email,
                ]);
            }

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error con GitHub: ' . $e->getMessage());
        }
    }
}