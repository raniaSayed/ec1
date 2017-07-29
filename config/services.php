<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => '1c8414c9b99f6ef9a5ca',
        'client_secret' => '22575444e23ac9ea73fdc09149178314ae5af1ec',
        'redirect' => 'http://localhost:8000/socialauth/github/callback',
    ],

    'facebook' => [
        'client_id' => '425957614455521',
        'client_secret' => '845990048f7bbd4a71c63b4a69cf04e4',
        'redirect' => 'http://localhost:8000/socialauth/facebook/callback',
    ],

    'google' => [
        'client_id' => '575492007034-eq0naqfkt90kid35fqsd7ftm30qrv671.apps.googleusercontent.com',
        'client_secret' => 'VveYEYik8sZ2Fuy0K2yD_UO_',
        'redirect' => 'http://localhost:8000/socialauth/google/callback',
    ],

];
