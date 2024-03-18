<?php

use App\Models\User;
use App\Models\Contrat;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('lieu_depart');
            $table->string('lieu_d_arrive');
            $table->string('date');
            $table->dateTime('debut_trajet')->default(now());
            $table->dateTime('fin_trajet')->nullable();
            $table->string('prix_du_trajet');
            $table->unsignedBigInteger('client_id') -> nullable();
            $table->unsignedBigInteger('chauffeur_id') -> nullable();


            $table->foreign('client_id')
                -> references('id')
                -> on('users')
                -> constrained()
                -> cascadeOnUpdate()
                -> cascadeOnDelete();

            $table->foreign('client_id')
                -> references('id')
                -> on('users')
                -> constrained()
                -> cascadeOnUpdate()
                -> cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
