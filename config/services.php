<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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

    'facebook' => [
        'client_id'     =>'364937900661491',
        'client_secret' =>'a501b732dcb3a8b95936cfc54dabb5c0',
        'redirect' => 'https://emergingncr.com/talktoastro/login/facebook/callback',
    ],

     'google' => [
        'client_id' => '895572091767-2sepfq5e9n1j6koo4fkrlu4vei9fa0rq.apps.googleusercontent.com',
        'client_secret' =>'aGxonYL5JTDPgh_anmIwP7Dw',
        'redirect' => env('APP_URL') . 'login/google/callback',
    ],


];
