<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard()
    {
        return view('users.dashboard');
    }


    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|min:4',
        ]);

        // Hasher le mot de passe
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Créer l'utilisateur
        $user = User::create($validatedData);

        // Authentifier l'utilisateur directement après l'inscription
        Auth::login($user);

        // Rediriger l'utilisateur vers la page dashboard
        return redirect('/dashboard');
    }


    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        // Valider les données du formulaire
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenter de connecter l'utilisateur
        if (Auth::attempt($credentials)) {
            // Authentification réussie, rediriger vers la page dashboard
            return redirect('/dashboard');
        } else {
            // Authentification échouée
            return back()->withErrors(['email' => 'Les informations de connexion sont incorrectes.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
