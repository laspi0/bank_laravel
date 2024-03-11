<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Card;
use App\Models\SubscriptionPack;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

    public function showPurchaseForm()
    {
        return view('client.purchase');
    }

    public function purchasePack(Request $request)
    {
        // Validation des données de la demande
        $request->validate([
            'name' => 'required',
            'ceiling' => 'required|numeric|min:0',
            'agio' => 'required|numeric|min:0',
        ]);

        // Obtenez l'utilisateur authentifié
        $user = auth()->user();

        // Vérifiez si l'utilisateur a déjà un pack d'abonnement
        if ($user->subscriptionPack) {
            // L'utilisateur a déjà un pack, vous pouvez choisir de le mettre à jour ou de renvoyer un message d'erreur
            return redirect()->back()->with('error', 'Vous avez déjà un pack d\'abonnement.');
        }

        // Créez un nouveau pack d'abonnement
        $pack = new SubscriptionPack();
        $pack->name = $request->input('name');
        $pack->ceiling = $request->input('ceiling');
        $pack->agio = $request->input('agio');
        $pack->user_id = $user->id; // Associez le pack à l'utilisateur
        $pack->save();

        // Redirigez l'utilisateur avec un message de succès
        return redirect()->back()->with('success', 'Pack d\'abonnement acheté avec succès.');
    }

    public function userTransactions()
    {
        $user = auth()->user(); // Récupérer l'utilisateur authentifié
        $transactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with('receiver') // Charger la relation du receveur seulement
            ->orderBy('created_at', 'desc')
            ->get();

        // Ajout du nom du receveur aux transactions
        foreach ($transactions as $transaction) {
            if ($transaction->receiver_id == $user->id) {
                $transaction->receiver_name = $user->name; // Nom du receveur est le nom de l'utilisateur actuel
            } else {
                $transaction->receiver_name = $transaction->receiver->name; // Nom du receveur est le nom du receveur dans la transaction
            }
        }

        return view('client.transaction', compact('transactions'));
    }

    public function calculateTransferFee(Request $request)
    {
        $amount = $request->input('amount');

        // Calculer les frais de transfert en tant que pourcentage du montant
        $transferFeePercentage = 0.05; // 5% de frais de transfert
        $transferFee = $amount * $transferFeePercentage;

        // Arrondir les frais de transfert à deux décimales
        $transferFee = round($transferFee, 2);

        return response()->json(['transfer_fee' => $transferFee]);
    }

    public function transfer(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour effectuer cette action.');
        }

        // Validation des données de formulaire
        $request->validate([
            'receiver_account_number' => 'required|exists:users,account_number',
            'amount' => 'required|numeric|min:0',
            'password' => 'required',
        ]);

        // Obtenir l'utilisateur expéditeur
        $sender = auth()->user();

        // Vérifier le mot de passe de l'utilisateur
        if (!Hash::check($request->password, $sender->password)) {
            return redirect()->route('transfer-form')->with('error', 'Mauvais mot de passe.');
        }

        // Obtenir le montant du transfert et le numéro de compte du destinataire
        $amount = $request->amount;
        $receiverAccountNumber = $request->receiver_account_number;

        // Vérifier si l'utilisateur a un pack d'abonnement
        $subscriptionPack = $sender->subscriptionPack;

        // Calculer le montant total à transférer (incluant les frais de transfert)
        $totalAmount = $amount;

        // Vérifier si le solde de l'expéditeur est suffisant
        if ($sender->balance < $totalAmount) {
            return redirect()->route('transfer-form')->with('error', 'Solde insuffisant.');
        }

        // Rechercher le destinataire par numéro de compte
        $receiver = User::where('account_number', $receiverAccountNumber)->first();

        // Déduire le montant total du plafond du pack d'abonnement de l'expéditeur
        if ($subscriptionPack) {
            $subscriptionPack->ceiling -= $amount;
            $subscriptionPack->save();
        }

        // Déduire le montant total du solde de l'expéditeur
        $sender->balance -= $totalAmount;
        $sender->save();

        // Augmenter le solde du destinataire
        $receiver->balance += $amount;
        $receiver->save();

        // Générer une référence unique sans caractères spéciaux
        $reference = strtoupper(substr(str_replace('-', '', Str::uuid()), 0, 12));

        // Enregistrer la transaction avec la référence unique
        $transaction = new Transaction();
        $transaction->sender_id = $sender->id;
        $transaction->receiver_id = $receiver->id;
        $transaction->amount = $amount;
        $transaction->reference = $reference;
        $transaction->save();

        // Rediriger avec un message de succès
        return redirect()->route('transfer-form')->with('success', 'Argent transféré avec succès.');
    }


    public function showCardForm()
    {
        return view('client.cardForm');
    }

    public function showUserCards()
{
    $user = auth()->user();
    $cards = Card::where('user_id', $user->id)->get();
    return view('client.cards', compact('cards'));
}


    public function createCard(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'name' => 'required|string',
            'cvv' => 'required|string',
        ]);
    
        // Générer un numéro de carte aléatoire (exemple)
        $cardNumber = mt_rand(1000000000000000, 9999999999999999); // Générer un nombre aléatoire de 16 chiffres
    
        // Créer une nouvelle instance de carte avec les données fournies
        $card = new Card();
        $card->name = $request->input('name');
        $card->cvv = $request->input('cvv');
        $card->card_number = $cardNumber; // Utiliser le numéro de carte généré
        $card->creation_date = Carbon::now();
        $card->expiration_date = Carbon::now()->addYears(5); // Exemple : Date d'expiration dans 5 ans
        $card->user_id = auth()->id(); // ID de l'utilisateur authentifié
    
        // Enregistrer la carte dans la base de données
        $card->save();
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Carte créée avec succès.');
    }
}
