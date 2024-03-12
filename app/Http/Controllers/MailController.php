<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Compte;
use App\Models\User;

class MailController extends Controller
{
    public function sendTestEmail()
    {
        $user = User::find(5); // Remplacez l'ID par celui de l'utilisateur auquel vous souhaitez envoyer l'e-mail
        $accountNumber = '123456'; // Valeur de démonstration pour le numéro de compte
        $nationalId = 'ABCD1234'; // Valeur de démonstration pour l'ID national
        Mail::to($user->email)->send(new Compte($accountNumber, $nationalId));
        return "Test email sent!";
    }
}
