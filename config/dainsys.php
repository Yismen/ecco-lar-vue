<?php

return [
    /*
     * Define the name of the app. This can be consistent
     * all accross the app. Set this in your ".env" file.
     */
    'app_name' => env('APP_NAME', 'Dainsys'),

    /*
     * The name of the company using the app. This name will
     * be used a the top of the page, as well as at the
     * bottom. Set this in your ".env" file.
     */
    'client_name' => env('CLIENT_NAME', 'Dainsys'),

    /*
     * A short name of the client. Set this in your ".env" file.
     */
    'client_name_mini' => env('CLIENT_NAME_SHORT', 'DAINSYS'),

    /*
     * Admin LTE color skins. Set this in your ".env" file.
     */
    'layout_color' => env('APP_COLOR', 'skin-yellow'), // blue, black, purple, yellow, red, green

    /*
     * Admin LTE layouts. Set this in your ".env" file.
     */
    'layout' => env('LAYOUT', 'default'), // default, fixed, layout-boxed, layout-top-nav

    /*
     * Whether or not the mini sidebar should be visible.
     */
    'sidebar_mini' => '', // sidebar-mini, ''

    /*
     * Admin LTE option to hide or show the sidebar by default.
     */
    'sidebar_collapse' => '', // sidebar-collapse, ''

    /*
     * Flash Notification positions.
     * options: top|top-start|top-end|center|center-start|center-end|bottom|bottom-start|bottom-end
     */
    'flash_position' => env('FLASH_POSITION', 'bottom-end'),
    
    /**
     *  Whether or not the fash messages should be shown as a toast.
     */
    'flash_as_toast' => env('FLASH_AS_TOAST', false),

    /*
    |--------------------------------------------------------------------------
    | Emergency Memory Limit
    |--------------------------------------------------------------------------
    |
    | Here we set the memory limit for PHP. Done here to avoid
    | code dig in case it we need to change this property.
    |
    */
    'memory_limit' => env('EMERGENCY_MEMORY_LIMIT', '1G'),

    /**
     * Dropbox api token
     */
    'dropbox_token' => env('DROPBOX_TOKEN'),

    'capillus' => [
        /**
        * Capillus Distro List
        *
        * This must be set in the env and have to be separated by the pipe symbol (|)
        */
        'distro' => env('CAPILLUS_FLASH_DISTRO', config('mail.from.address')),
        
        /**
         * Capillus Campaigns List
         *
         * A list of the campaigns for Capillus
         * This must be set in the env and have to be separated by the pipe symbol (|)
         */
        'campaigns' =>env('CAPILLUS_CAMPAIGNS', 'Capillus DRTV|Capillus Email|Capillus Sales|Capillus Caller ID|Capillus DRTV Route|Capillus Sales Route')
    ],

    'political' => [
        'distro' => env('POLITICAL_FLASH_DISTRO', config('mail.from.address')),
    ], 

    'dashboards' => [
        'roles_hierarchy' => [
            // 'admin' => 'AdminDashboardController',
            // 'owner' => 'AdminDashboardController',
            // 'management' => 'AdminDashboardController',
        ]
    ]
];
