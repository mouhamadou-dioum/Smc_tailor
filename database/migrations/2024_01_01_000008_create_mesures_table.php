<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('nom')->nullable();
            $table->decimal('cou', 5, 2)->nullable();
            $table->decimal('epaule', 5, 2)->nullable();
            $table->decimal('manche', 5, 2)->nullable();
            $table->decimal('hanche', 5, 2)->nullable();
            $table->decimal('tourbras', 5, 2)->nullable();
            $table->decimal('longueurChemise', 5, 2)->nullable();
            $table->decimal('longueurBoubou', 5, 2)->nullable();
            $table->decimal('longueurPantalon', 5, 2)->nullable();
            $table->decimal('cuisse', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesures');
    }
};