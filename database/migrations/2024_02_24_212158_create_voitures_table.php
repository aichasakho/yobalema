<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('image_voiture');
            $table->enum('type_de_voiture', ['Camion', 'Voiture', 'Bus']);
            $table->date('date_achat');
            $table->float('km_par_defaut');
            $table->float('km_actuel');
            $table->enum('statut', ['Marche', 'Panne', ' location']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
