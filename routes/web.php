<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TellerController;
use App\Http\Controllers\ClientController;

Route::get('client/transaction', [ClientController::class, 'userTransactions'])->name('user.transactions');
Route::get('/calculate-transfer-fee', [ClientController::class, 'calculateTransferFee'])->name('calculate-transfer-fee');
Route::get('client/transfer', [ClientController::class, 'showTransferForm'])->name('transfer-form');
Route::post('client/transfer', [ClientController::class, 'transfer'])->name('transfer');
Route::get('client/purchase', [ClientController::class, 'showPurchaseForm'])->name('purchase.form');
Route::post('client/purchase', [ClientController::class, 'purchasePack'])->name('purchase.pack');
Route::get('client/cards/create', [ClientController::class, 'showCardForm'])->name('cards.create');
Route::post('client/cards', [ClientController::class, 'createCard'])->name('cards.store');
Route::get('client/cards', [ClientController::class, 'showUserCards'])->name('cards.index');
Route::get('client/savings/create', [ClientController::class, 'showSavingForm'])->name('savings.create');
Route::post('client/savings', [ClientController::class, 'createSaving'])->name('saving.create');






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
    return view('users.login');
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
Route::get('/teller/create', [AccountController::class, 'showTellerForm'])->name('teller.create');
Route::post('/teller/create', [AccountController::class, 'createTeller'])->name('teller.store');


