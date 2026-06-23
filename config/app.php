<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nom de l'application
    |--------------------------------------------------------------------------
    |
    | Cette valeur correspond au nom de votre application, qui sera utilisé
    | lorsque le framework devra placer le nom de l'application dans une
    | notification ou tout autre élément d'interface utilisateur (UI).
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Environnement de l'application
    |--------------------------------------------------------------------------
    |
    | Cette valeur détermine l'environnement dans lequel votre application est
    | actuellement exécutée. Cela peut influencer la configuration de divers
    | services utilisés par l'application. Définissez ceci dans votre fichier .env.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Mode de débogage de l'application
    |--------------------------------------------------------------------------
    |
    | Lorsque votre application est en mode de débogage, des messages d'erreur
    | détaillés avec des traces d'exécution (stack traces) seront affichés
    | à chaque erreur. S'il est désactivé, une page d'erreur générique s'affiche.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL de l'application
    |--------------------------------------------------------------------------
    |
    | Cette URL est utilisée par la console pour générer correctement les URL
    | lors de l'utilisation de l'outil en ligne de commande Artisan. Vous devez
    | définir ceci à la racine pour qu'elle soit disponible dans Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuseau horaire de l'application
    |--------------------------------------------------------------------------
    |
    | Ici, vous pouvez spécifier le fuseau horaire par défaut de l'application,
    | qui sera utilisé par les fonctions de date et d'heure de PHP. Par défaut,
    | le fuseau horaire est défini sur "UTC", ce qui convient à la plupart des cas.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuration de la langue (locale) de l'application
    |--------------------------------------------------------------------------
    |
    | La langue de l'application détermine la langue par défaut utilisée par les
    | méthodes de traduction et d'internationalisation de Laravel. Cette option
    | peut être définie sur n'importe quelle langue disponible dans vos fichiers.
    |
    */

    // CORRECTIF LOCALE : Définie sur 'fr' (français) par défaut pour s'adapter à la langue de l'application
    'locale' => env('APP_LOCALE', 'fr'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'fr'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Clé de chiffrement (Encryption Key)
    |--------------------------------------------------------------------------
    |
    | Cette clé est utilisée par les services de chiffrement de Laravel et doit
    | être définie sur une chaîne aléatoire de 32 caractères pour garantir que
    | toutes les valeurs chiffrées sont sécurisées. Faites-le avant le déploiement.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Pilote du mode maintenance (Maintenance Mode Driver)
    |--------------------------------------------------------------------------
    |
    | Ces options de configuration déterminent le pilote utilisé pour gérer et
    | déterminer le statut du "mode maintenance" de Laravel. Le pilote "cache"
    | permet de contrôler le mode de maintenance sur plusieurs machines.
    |
    | Pilotes supportés : "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mode Thème de l'application
    |--------------------------------------------------------------------------
    |
    | Détermine quel thème afficher : 'client' (SMC Couture original) ou
    | 'alternative' (AURA Couture haut de gamme, version "vendue").
    |
    */
    'theme_mode' => env('APP_THEME_MODE', 'client'),

];
