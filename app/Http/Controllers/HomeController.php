<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Voiture;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    private array $categories = array(
        "Camion" => 'Camion',
        "Voiture" => 'Voiture',
        'Bus' => 'Bus',
    );


    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     {
    //     $voitures_count = Voiture::all()->count();
    //     $locations_count = Location::all()->count();
    //     return view('client.index', [
    //         'voitures_count' => $voitures_count,
    //         'locations_count' => $locations_count,
    //         'categories' => $this->categories
    //     ]);
     }
}
