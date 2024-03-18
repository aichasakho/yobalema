<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voiture>
 */
class VoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [

                'matricule' => strtoupper($this->faker->unique()->word),
                'image_vehicule' => $this->faker->imageUrl(),
                'date_achat' => $this->faker->date,
                'km_defaut' => $this->faker->numberBetween(0, 10000),
                'km_actuel' => $this->faker->numberBetween(1000, 50000),
                'statut' => 'Marche',
                'categorie' => $this->faker->randomElement(['Camion', 'Voiture', 'Bus']),


        ];
    }
}
