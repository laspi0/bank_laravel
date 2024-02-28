<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route pour la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes pour l'inscription
Route::get('/register', [UserController::class, 'create'])->name('register.create');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Routes pour la connexion
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



use App\Http\Controllers\AccountController;

Route::get('/create', [AccountController::class, 'showCreateForm'])->name('accounts.create');
Route::post('/accounts', [AccountController::class, 'create'])->name('accounts.store');
Route::post('/check-unique', [AccountController::class, 'checkUnique']);
