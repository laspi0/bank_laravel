<?php
// app/Http/Controllers/TellerController.php

namespace App\Http\Controllers;

class TellerController extends Controller
{
    public function dashboard()
    {
        // Logique spécifique au tableau de bord du guichetier
        return view('dashboard_teller');
    }
}
