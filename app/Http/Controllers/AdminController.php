<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function getClients()
    {
        $clients = User::where('profile_type', 'client')->get();
        return view('admin.clients', ['clients' => $clients]);
    }

    public function getTellers()
    {
        $tellers = User::where('profile_type', 'teller')->get();

        return view('admin.tellers', ['tellers' => $tellers]);
    }

    public function toggleStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Utilisateur non trouvé.'], 404);
        }
        $status = $request->input('status');
        $user->account_status = $status === 'active' ? 'blocked' : 'active';
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Statut de l\'utilisateur mis à jour avec succès.', 'new_status' => $user->account_status]);
    }
}
