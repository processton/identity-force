<?php

return [

    // Theme settings
    'theme' => 'default',

    // Application name
    'name' => 'Processton',

    // Application logo
    'logo' => '/logo.png',

    // Registeration settings
    'registeration' => [

        // Enable/disable registeration
        'enabled' => true,

        // Enable/disable email verification
        'email_verification' => true
    ],

    // Team settings
    'teams' => [

        // Enable/disable teams
        'enabled' => true,

        // Team limitations
        'limit' => [

            // Number of teams can be created (0 for unlimited)
            'total' => 0,

            // Number of members can be added to a team (0 for unlimited)
            'members' => 5,

            // Number of teams can be created by a user (0 for unlimited)
            'per_user' => 5

        ]

    ],

    // Two factor authentication settings
    'mfa' => [

        // Enable/disable two factor authentication
        'policy' => 'disabled', // disabled, relaxed, enforced, restricted

        // Two factor authentication providers
        'providers' => [

            // Enable/disable providers
            'google' => true,

            // Enable/disable email otp
            'email' => true,

            // Enable/disable sms otp
            'sms' => true

        ]
    ],

    // Tenant Administration
    'admin' => [

        // Enable/disable tenant administration
        'identification' => 'email', // email, team

        // Allowed teams / user emails
        'in' =>[
            // Forexample tems (e.g: admin) or emails (e.g: user@example.com)
            'Admin',
            'admin@processton.com'
        ]
    ],


    // Embed settings
    'embed' => [

        // Enable/disable login embed
        'login' => true,

        // Enable/disable register embed
        'register' => true,

        // Enable/disable forgot password embed
        'forgot_password' => true,
    ],

];
