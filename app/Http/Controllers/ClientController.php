<?php
// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

class ClientController extends Controller
{
    public function dashboard()
    {
        // Logique spécifique au tableau de bord du client
        return view('dashboard_client');
    }
}
