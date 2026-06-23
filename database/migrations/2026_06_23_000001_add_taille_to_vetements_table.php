<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vetements', function (Blueprint $table) {
            $table->string('taille')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('vetements', function (Blueprint $table) {
            $table->dropColumn('taille');
        });
    }
};
