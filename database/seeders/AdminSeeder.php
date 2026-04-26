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
                'telephone' => '221778629935',
                'motDePasse' => Hash::make('admin123'),
            ]
        );
        $this->command->info('Admin créé avec succès !');
    }
}