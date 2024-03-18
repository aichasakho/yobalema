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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->integer('commentaire');
            $table->foreignIdFor(\App\Models\User::class)
            ->constrained() -> onDelete('cascade');
            $table->foreignIdFor(\App\Models\Chauffeur::class)
                ->constrained() -> onDelete('cascade');
            $table->foreignIdFor(\App\Models\Location::class)
                ->constrained() -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
