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
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voiture_id');
            $table->string('experience');
            $table->string('numero_permis')->unique();
            $table->string('date_emission');
            $table->string('date_expiration');
            $table->enum('categorie', ['A1', 'A', 'B', 'C']);//* Les categories : A => motos, B => voiture, C => camion
            $table->string('image');
            $table->foreign('voiture_id')->references('id')->on('voitures') ->nullable()
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->boolean('is_permis_valide');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chauffeurs');
    }
};
