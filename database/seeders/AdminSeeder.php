<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@couture.com')],
            [
                'nom'        => env('ADMIN_NOM', 'Admin'),
                'telephone'  => env('ADMIN_TELEPHONE', '221770000000'),
                'motDePasse' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMe123!')),
            ]
        );
        $this->command->info('Admin créé avec succès !');
    }
}