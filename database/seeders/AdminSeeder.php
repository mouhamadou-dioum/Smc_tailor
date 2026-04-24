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
            ['email' => 'loufadioum2004@gmail.com'],
            [
                'nom'        => 'Admin',
                'motDePasse' => Hash::make('admin123'),
            ]
        );
        $this->command->info('Admin créé avec succès !');
    }
}