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
        'client_id'     =>'197595180893356',
        'client_secret' =>'802408c735068d8176c2369a24186adb',
        'redirect' => env('APP_URL').'login/facebook/callback',
    ],

     'google' => [
        'client_id' => '401264671681-ma74emm2ph8eu6hnlhkjuhu9iukjifku.apps.googleusercontent.com',
        'client_secret' =>'o8V-Ho7oRlU1H9JNA5ZCqlh6',
        'redirect' => env('APP_URL') . 'login/google/callback',
    ],


];
