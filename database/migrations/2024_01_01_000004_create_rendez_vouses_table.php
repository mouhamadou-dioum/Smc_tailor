<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateRendezVous');
            $table->string('heure');
            $table->enum('statut', ['EN_ATTENTE', 'CONFIRME', 'REFUSE'])->default('EN_ATTENTE');
            $table->text('commentaire')->nullable();
            $table->timestamp('dateCreation')->nullable();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('vetement_id')->nullable()->constrained('vetements')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
