<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PriceRule Module Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the configuration settings for the PriceRule module.
    |
    */

    'name' => 'PriceRule',
    'version' => '1.0.0',
    'description' => 'PriceRule module for the application',
    'author' => 'Your Name',
    'email' => 'your.email@example.com',
    'website' => 'https://example.com',

    /*
    |--------------------------------------------------------------------------
    | Module Settings
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the settings for the PriceRule module.
    |
    */

    'settings' => [
        'enabled' => true,
        'debug' => false,
        'cache' => true,
        'cache_ttl' => 3600,
    ],

    /*
    |--------------------------------------------------------------------------
    | Module Dependencies
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the dependencies for the PriceRule module.
    |
    */

    'dependencies' => [
        // 'Core',
        // 'Auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Module Permissions
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the permissions for the PriceRule module.
    |
    */

    'permissions' => [
        'view' => 'View PriceRule',
        'create' => 'Create PriceRule',
        'edit' => 'Edit PriceRule',
        'delete' => 'Delete PriceRule',
    ],
]; 