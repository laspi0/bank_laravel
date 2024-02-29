<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TellerController extends Controller
{
    /**
     * Affiche le formulaire de dépôt.
     *
     * @return \Illuminate\View\View
     */
    public function showDepositForm()
    {
        return view('teller.deposit');
    }
    public function showWithdrawalForm()
    {
        return view('teller.withdrawal');
    }
    public function showBalanceForm()
    {
        return view('teller.balance');
    }

    public function getClientInfo(Request $request)
    {
        $accountNumber = $request->input('account_number');
        $client = User::where('account_number', $accountNumber)->first();

        if ($client) {
            return response()->json(['success' => true, 'client_name' => $client->first_name . ' ' . $client->last_name]);
        } else {
            return response()->json(['success' => false, 'message' => 'Aucun client trouvé avec ce numéro de compte']);
        }
    }


    // Méthode pour récupérer le solde et le nom du titulaire d'un compte
    public function getAccountBalance(Request $request)
    {
        $accountNumber = $request->input('account_number');
        $password = $request->input('password');
        $account = User::where('account_number', $accountNumber)->first();

        if ($account) {
            // Vérifie le mot de passe
            if (Hash::check($password, $account->password)) {
                return response()->json(['success' => true, 'name' => $account->first_name . ' ' . $account->last_name, 'balance' => $account->balance]);
            } else {
                return response()->json(['success' => false, 'message' => 'Mot de passe incorrect']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Aucun compte trouvé avec ce numéro']);
        }
    }




    public function makeWithdrawal(Request $request)
    {
        $accountNumber = $request->input('account_number');
        $amount = $request->input('amount');
        $password = $request->input('password');

        // Récupère le compte associé au numéro de compte
        $account = User::where('account_number', $accountNumber)->first();

        if ($account) {
            // Vérifie le mot de passe
            if (Hash::check($password, $account->password)) {
                // Vérifie si le solde est suffisant pour le retrait
                if ($account->balance >= $amount) {
                    DB::beginTransaction();
                    try {
                        // Effectue le retrait en mettant à jour le solde du compte
                        $account->balance -= $amount;
                        $account->save();
                        DB::commit();
                        return response()->json(['success' => true, 'message' => 'Retrait effectué avec succès']);
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json(['success' => false, 'message' => 'Une erreur est survenue lors du retrait']);
                    }
                } else {
                    return response()->json(['success' => false, 'message' => 'Solde insuffisant']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Mot de passe incorrect']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Aucun compte trouvé avec ce numéro']);
        }
    }


    /**
     * Traite le dépôt lorsque le formulaire est soumis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeDeposit(Request $request)
    {
        // Récupère le numéro de compte à partir de la requête
        $accountNumber = $request->input('account_number');

        // Récupère le montant du dépôt à partir de la requête
        $amount = $request->input('amount');

        // Récupère le compte associé au numéro de compte
        $account = User::where('account_number', $accountNumber)->first();

        // Vérifie si le compte existe
        if ($account) {
            // Effectue le dépôt en mettant à jour le solde du compte
            DB::beginTransaction();
            try {
                $account->balance += $amount;
                $account->save();
                DB::commit();
                return response()->json(['message' => 'Dépôt effectué avec succès']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'Une erreur est survenue lors du dépôt']);
            }
        } else {
            return response()->json(['error' => 'Aucun compte trouvé avec ce numéro']);
        }
    }
}
