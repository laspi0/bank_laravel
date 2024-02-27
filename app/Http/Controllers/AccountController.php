<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function showCreateForm()
    {
        return view('accounts.create');
    }

    public function create(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'account_number' => 'nullable|unique:users|sometimes|required',
            'branch_number' => 'nullable|required',
            'function' => 'nullable|required',
            'address' => 'nullable|required',
            'first_name' => 'nullable|required',
            'last_name' => 'nullable|required',
            'phone' => 'nullable|required',
            'national_id' => 'nullable|unique:users|sometimes|required',
            'email' => 'nullable|email|unique:users|sometimes|required',
            'password' => 'nullable|required|min:4',
            'account_type' => 'nullable|required',
            'profile_type' => 'nullable|required',
        ]);

        // Hasher le mot de passe
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Créer le compte utilisateur
        User::create($validatedData);

        // Rediriger l'utilisateur vers une page de confirmation ou toute autre page appropriée
        return redirect('/')->with('success', 'Le compte a été créé avec succès.');
    }
}
