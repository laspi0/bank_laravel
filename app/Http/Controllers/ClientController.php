<?php
// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function dashboard()
    {
        // Logique spécifique au tableau de bord du client
        return view('dashboard_client');
    }

    public function showTransferForm()
    {
        return view('client.transfer');
    }

    public function transfer(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to perform this action.');
        }

        $request->validate([
            'receiver_account_number' => 'required|exists:users,account_number',
            'amount' => 'required|numeric|min:0',
            'password' => 'required',
        ]);

        $sender = auth()->user(); // Obtenez l'utilisateur authentifié

        // Vérifier si l'expéditeur est null
        if (!$sender) {
            return redirect()->route('login')->with('error', 'You must be logged in to perform this action.');
        }

        $receiverAccountNumber = $request->input('receiver_account_number');
        $amount = $request->input('amount');
        $password = $request->input('password');

        // Vérification du mot de passe
        if (!Hash::check($password, $sender->password)) {
            return redirect()->route('transfer-form')->with('error', 'Wrong password.');
        }

        // Vérification du solde suffisant
        if ($sender->balance < $amount) {
            return redirect()->route('transfer-form')->with('error', 'Insufficient balance.');
        }

        // Recherche du destinataire par numéro de compte
        $receiver = User::where('account_number', $receiverAccountNumber)->first();

        // Mise à jour du solde de l'expéditeur
        $sender->balance -= $amount;
        $sender->save();

        $receiver->balance += $amount;
        $receiver->save();

        $transaction = new Transaction();
        $transaction->sender_id = $sender->id;
        $transaction->receiver_id = $receiver->id;
        $transaction->amount = $amount;
        $transaction->save();

        return redirect()->route('transfer-form')->with('success', 'Money transferred successfully.');
    }
}
