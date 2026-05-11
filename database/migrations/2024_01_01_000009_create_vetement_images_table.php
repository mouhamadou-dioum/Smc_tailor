<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vetement_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vetement_id')->constrained('vetements')->onDelete('cascade');
            $table->string('image_url');
            $table->tinyInteger('ordre')->default(0);
            $table->timestamps();
        });

        DB::table('vetements')->whereNotNull('imageUrl')->orderBy('id')->each(function ($vetement) {
            DB::table('vetement_images')->insert([
                'vetement_id' => $vetement->id,
                'image_url'   => $vetement->imageUrl,
                'ordre'       => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vetement_images');
    }
};
