<?php
// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
        $request->validate([
            'receiver_account_number' => 'required|exists:users,account_number',
            'amount' => 'required|numeric|min:0',
        ]);

        $sender = auth()->user();
        $receiverAccountNumber = $request->input('receiver_account_number');
        $amount = $request->input('amount');

        // Check if sender has enough balance
        if ($sender->balance < $amount) {
            return redirect()->route('transfer-form')->with('error', 'Insufficient balance.');
        }

        // Find receiver user by account number
        $receiver = User::where('account_number', $receiverAccountNumber)->first();

        // Update sender's balance
        $sender->balance -= $amount;
        $sender->save();

        // Update receiver's balance
        $receiver->balance += $amount;
        $receiver->save();

        return redirect()->route('transfer-form')->with('success', 'Money transferred successfully.');
    }
}
