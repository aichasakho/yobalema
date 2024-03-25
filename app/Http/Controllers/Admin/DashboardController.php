<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payement;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    /**
     * Retourne la vue principale du tableau de bord coté administration
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $chauffeurs = [];
        $users = User::with('chauffeurs.voiture', 'contrats')
            -> where('role_user_id', '=',3)
            -> limit(10)->get();
        foreach ($users as $user){
            if($user->chauffeurs?->numero_permis != null){
                $chauffeurs[] = $user;
            }
        }

        $clients = User::where('role_user_id', '=', 2)
            ->orderBy('created_at', 'desc') -> get();

        $payements = Payement::all();

        return view('admin.dashboard',
         compact('chauffeurs', 'clients', 'payements')
        );
    }
}
