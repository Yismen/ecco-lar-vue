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
    'client_name' => env('CLIENT_NAME', 'Dainsys \' Client Name'),

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
    'sidebar_collapse' => 'sidebar-collapse', // sidebar-collapse, ''

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

    /*
    * Menu
    */
    'menu' => [
        [
            'title' => 'human-resources',
            'items' => [
                'employees',
                'sites',
                'campaigns',
            ],
        ],
        [
            'title' => 'statistic',
            'items' => 'human-resources',
        ],
    ],
];
