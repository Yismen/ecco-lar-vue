<?php

return [
    /**
     * Define the name of the app. This can be consistent
     * all accross the app.
     */
    'app_name' => env('APP_NAME', 'Dainsys'),

    /**
     * The name of the company using the app. This name will 
     * be used a the top of the page, as well as at the 
     * bottom.
     */
    'client_name' => env('CLIENT_NAME', 'Ecco Outsourcing'),

    /**
     * A short name of the client. 
     */
    'client_name_mini' => env('CLIENT_NAME_SHORT', 'ECCO'),

    /**
     * Admin LTE color skins. Options are:
     * blue, black, purple, yellow, red, green 
     */
    'layout_color' => env('APP_COLOR', 'yellow'), 

    /**
     * Admin LTE layouts. Options are:
     * fixed, layout-boxed, layout-top-nav
     */
    'layout' => 'fixed',

    /**
     * Whether or not the mini sidebar should be visible. Options are:
     * sidebar-mini, ''
     */
    'sidebar_mini' => 'sidebar-mini',
    
    /**
     * Admin LTE option to hide or show the sidebar by default. Options are:
     * sidebar-collapse, ''
     */
    'sidebar_collapse' => '',


];