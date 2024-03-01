<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TellerController;
use App\Http\Controllers\ClientController;




Route::get('client/transfer', [ClientController::class, 'showTransferForm'])->name('transfer-form');
Route::post('client/transfer', [ClientController::class, 'transfer'])->name('transfer');



// Affiche le formulaire de dépôt
Route::get('teller/deposit', [TellerController::class, 'showDepositForm']);
Route::post('teller/deposit', [TellerController::class, 'makeDeposit'])->name('deposit.make');
Route::get('/get-client-info', [TellerController::class, 'getClientInfo'])->name('get.client.info');
Route::get('teller/withdrawal', [TellerController::class, 'showWithdrawalForm']);
Route::post('teller/withdrawal', [TellerController::class, 'makeWithdrawal'])->name('withdrawal.make');
Route::get('teller/balance', [TellerController::class, 'showBalanceForm']);
Route::get('teller/get-account-balance', [TellerController::class, 'getAccountBalance'])->name('get.account.balance');

// Page d'accueil
Route::get('/', function () {
    return view('admin.welcome');
});

// Routes d'inscription
Route::get('/register', [UserController::class, 'create'])->name('register.create');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Routes de connexion
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



// Routes pour les tableaux de bord spécifiques aux profils

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'teller'])->group(function () {
    Route::get('/teller/dashboard', [UserController::class, 'tellerDashboard'])->name('teller.dashboard');
});

Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client/dashboard', [UserController::class, 'clientDashboard'])->name('client.dashboard');
});

use App\Http\Controllers\AdminController;

Route::get('/admin/clients', [AdminController::class, 'getClients']);
Route::get('/admin/tellers', [AdminController::class, 'getTellers'])->name('admin.tellers');
Route::get('/create', [AccountController::class, 'showCreateForm'])->name('accounts.create');
Route::post('/accounts', [AccountController::class, 'create'])->name('accounts.store');
Route::post('/check-unique', [AccountController::class, 'checkUnique']);




Route::post('/toggle-user-status', [AdminController::class, 'toggleStatus'])->name('toggle.user.status');
