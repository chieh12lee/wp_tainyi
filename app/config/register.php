<?php

namespace Domo;

/**
 * Registers a custom Navigation Menu in the custom menu editor
 */
function register_menus()
{

    register_nav_menu('service', __('Service menu', 'domo'));
}

// add_action('after_setup_theme', __NAMESPACE__ . '\register_menus');
function register_sidebars()
{
    $sidebar  = apply_filters('sidebar', [
        'name'          => __('Service Sidebar', 'domo'),
        'id'            => 'about-sidebar',
        'description'   => __('關於次選單.', 'domo'),
        'before_widget' => '<div style="">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="">',
        'after_title'   => '</h2>',
    ]);
    register_sidebar($sidebar);
}

// add_action('widgets_init', __NAMESPACE__ . '\\register_sidebars');