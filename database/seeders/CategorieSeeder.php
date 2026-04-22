<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Robe', 'description' => 'Robe de couture sur mesure pour toutes occasions'],
            ['nom' => 'Costume', 'description' => 'Costumes traditionnels et modernes'],
            ['nom' => 'Chemise', 'description' => 'Chemises personnalisées'],
            ['nom' => 'Tailleur', 'description' => 'Tailleurs pour femmes et hommes'],
            ['nom' => 'Mariage', 'description' => 'Tenues de mariage et robes de mariée'],
            ['nom' => 'Accessoire', 'description' => 'Accessoires de couture divers'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}