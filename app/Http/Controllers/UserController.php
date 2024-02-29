<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|min:4',
        ]);

        // Hashage du mot de passe
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Création de l'utilisateur
        $user = User::create($validatedData);

        // Authentification de l'utilisateur après l'inscription
        Auth::login($user);

        // Redirection vers le tableau de bord par défaut
        return redirect('/dashboard');
    }

    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        // Validation des données du formulaire
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative de connexion de l'utilisateur
        if (Auth::attempt($credentials)) {
            // Redirection vers le tableau de bord spécifique au type de profil
            switch (Auth::user()->profile_type) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    break;
                case 'teller':
                    return redirect()->route('teller.dashboard');
                    break;
                case 'client':
                    return redirect()->route('client.dashboard');
                    break;
                default:
                    return redirect('/dashboard');
                    break;
            }
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

    // Méthode pour le tableau de bord de l'administrateur
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    // Méthode pour le tableau de bord du guichetier
    public function tellerDashboard()
    {
        return view('teller.dashboard');
    }

    // Méthode pour le tableau de bord du client
    public function clientDashboard()
    {
        return view('client.dashboard');
    }
}
