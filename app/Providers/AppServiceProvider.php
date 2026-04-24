<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Forcer HTTPS en production — corrige l'alerte navigateur
        // "données du formulaire non sécurisées" et les erreurs de cookie sécurisé
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
