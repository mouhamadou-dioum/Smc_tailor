<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'whatsapp' => [
        'token' => env('WHATSAPP_TOKEN'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
        'default_country_code' => env('WHATSAPP_DEFAULT_COUNTRY_CODE', '221'),
        /*
         * Modèles Meta (WhatsApp Cloud). Laisser vide = envoi en message texte libre (fenêtre 24h / sandbox).
         * template_name : utilisé pour confirmer ET refuser si les clés *_confirm / *_refuse sont vides.
         * template_mode : "message" = 1 variable corps = texte complet | "fields" = 3 variables : date, heure, phrase statut
         */
        'template_name' => env('WHATSAPP_TEMPLATE_NAME'),
        'template_confirm_name' => env('WHATSAPP_TEMPLATE_CONFIRM_NAME'),
        'template_refuse_name' => env('WHATSAPP_TEMPLATE_REFUSE_NAME'),
        'template_lang' => env('WHATSAPP_TEMPLATE_LANG', 'fr'),
        'template_mode' => env('WHATSAPP_TEMPLATE_MODE', 'message'),
        'template_fallback_text' => filter_var(env('WHATSAPP_TEMPLATE_FALLBACK_TEXT', false), FILTER_VALIDATE_BOOL),
    ],

];
