<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mesures', function (Blueprint $table) {
            $table->string('photo_tissu')->nullable()->after('cuisse');
            $table->string('modele')->nullable()->after('photo_tissu');
            $table->string('photo_modele')->nullable()->after('modele');
        });
    }

    public function down(): void
    {
        Schema::table('mesures', function (Blueprint $table) {
            $table->dropColumn(['photo_tissu', 'modele', 'photo_modele']);
        });
    }
};
