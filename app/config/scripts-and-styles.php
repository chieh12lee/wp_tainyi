<?php

/**
 * Register scripts and styles and enqueue them
 */
function domo_scripts_and_styles()
{
    wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap', false);

    // wp_register_script('domo-modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');

    // wp_enqueue_script('domo-modernizr');
}

add_action('wp_enqueue_scripts', 'domo_scripts_and_styles', 999);

/**
 * Register Login Page scripts and styles and enqueue them
 */
// function domo_login_scripts_and_styles()
// {
// }

// add_action('login_enqueue_scripts', 'domo_login_scripts_and_styles', 999);

/**
 * Register Admin Page scripts and styles and enqueue them
 */
// function domo_admin_scripts_and_styles()
// {
// }

// add_action('admin_enqueue_scripts', 'domo_admin_scripts_and_styles', 999);
