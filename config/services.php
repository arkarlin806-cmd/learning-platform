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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),

        // 'project_id' => env('GOOGLE_CLOUD_PROJECT_ID'),         //ai chat text and audio
        // 'credentials' => storage_path('app/google/google-key.json'),
    ],

    'openai' => [
        'key' => env('OPENAI_API_KEY'),
    ],
    'zoom' => [
        'account_id'   => env('ZOOM_ACCOUNT_ID'),
        'client_id'    => env('ZOOM_CLIENT_ID'),
        'client_secret' => env('ZOOM_CLIENT_SECRET'),
    ],
    'video_call' => [
        'signal_server_url' => env('VIDEO_CALL_SIGNAL_SERVER_URL', 'http://127.0.0.1:4000'),
    ],

    'jitsi' => [
        'driver' => env('JITSI_DRIVER', 'jaas'),
        'domain' => env('JITSI_DOMAIN', '8x8.vc'),
        'app_id' => env('JITSI_APP_ID'),
        'kid' => env('JITSI_KID'),
        'private_key' => env('JITSI_PRIVATE_KEY'),
        'default_lang' => env('JITSI_DEFAULT_LANG', 'en'),
        'enable_prejoin' => filter_var(env('JITSI_ENABLE_PREJOIN', true), FILTER_VALIDATE_BOOL),
    ],
    'openrouter' => [
        'key' => env('OPENROUTER_API_KEY'),
        'model' => env('OPENROUTER_MODEL', 'openai/gpt-oss-20b')
    ],

    'groq' => [
        'key' => env('GROQ_API_KEY'),
    ],

];
