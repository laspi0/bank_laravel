<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
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
                    return redirect()->route('teller.balance');
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
        // Récupérer le nombre d'utilisateurs avec le profil "client"
        $countClients = User::where('profile_type', 'client')->count();

        // Récupérer le nombre d'utilisateurs avec le profil "teller"
        $countTellers = User::where('profile_type', 'teller')->count();

        // Récupérer la somme totale des balances de tous les utilisateurs
        $totalBalance = User::sum('balance');

        // Récupérer la somme des transactions hebdomadaires
        $weeklyTransactions = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');

        // Récupérer la somme des transactions journalières
        $dailyTransactions = Transaction::whereDate('created_at', Carbon::today())->sum('amount');

        // Récupérer la somme des transactions mensuelles
        $monthlyTransactions = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $totalTransactions = Transaction::count('amount');
        $annualBalance = User::sum('balance');



        // Passer les données à la vue
        return view('admin.dashboard', [
            'countClients' => $countClients,
            'countTellers' => $countTellers,
            'totalBalance' => $totalBalance,
            'weeklyTransactions' => $weeklyTransactions,
            'dailyTransactions' => $dailyTransactions,
            'monthlyTransactions' => $monthlyTransactions,
            'totalTransactions' => $totalTransactions,
            'annualBalance' => $annualBalance,
        ]);
    }

    // Méthode pour le tableau de bord du guichetier
    public function tellerDashboard()
    {
        return view('teller.dashboard');
    }

    // Méthode pour le tableau de bord du client
    public function clientDashboard()
    {
        $user = auth()->user();
        $sentTransactionCount = $user->sentTransactions()->count();
        $receivedTransactionCount = $user->receivedTransactions()->count();
        $totalTransactionCount = $sentTransactionCount + $receivedTransactionCount;

        $saving = $user->savings;

        $lastTransactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest()
            ->take(7)
            ->get();

        return view('client.dashboard', [
            'user' => $user,
            'totalTransactionCount' => $totalTransactionCount,
            'saving' => $saving,
            'lastTransactions' => $lastTransactions
        ]);
    }
}
