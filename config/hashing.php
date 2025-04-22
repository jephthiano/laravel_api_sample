<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hashing Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hashing driver that will be used by your
    | application. You may use the "bcrypt" or "argon" drivers. A default driver
    | has been set for you but you are free to change it to any of the supported
    | drivers.
    |
    */

    'driver' => env('HASHING_DRIVER', 'bcrypt'),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may configure the options for the bcrypt hashing driver. This will
    | allow you to control the "cost" of bcrypt hashing. Higher values will be
    | more secure, but slower. The default value is 10, which is good for most
    | applications.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | If you wish to use the "argon" driver for hashing, you may configure the
    | options for it here. Argon is a secure hashing algorithm and is preferred
    | over bcrypt if you're using newer versions of PHP.
    |
    */

    'argon' => [
        'memory' => env('ARGON_MEMORY', 1024),
        'time' => env('ARGON_TIME', 2),
        'threads' => env('ARGON_THREADS', 2),
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon2id Options
    |--------------------------------------------------------------------------
    |
    | Argon2id is an even more secure version of Argon. You may configure the
    | options for it here as well.
    |
    */

    'argon2id' => [
        'memory' => env('ARGON2_MEMORY', 1024),
        'time' => env('ARGON2_TIME', 2),
        'threads' => env('ARGON2_THREADS', 2),
    ],
];
