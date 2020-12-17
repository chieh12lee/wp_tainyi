<?php

namespace Tinymce;

add_action('init', __NAMESPACE__ . '\\shortcode_button_init');
function shortcode_button_init()
{
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages') &&  get_user_option('rich_editing') == 'true')
        return;

    if (class_exists('easyFootnotes')) {
        # code...
        add_filter("mce_external_plugins", __NAMESPACE__ . '\\register_tinymce_plugin');
        add_filter('mce_buttons',  __NAMESPACE__ . '\\add_tinymce_button');
    }
}

function register_tinymce_plugin($plugin_array)
{
    $plugin_array['footnote_shortcode_button'] = get_template_directory_uri() . '/app/exts/tinymice/footnote_shortcode_button.js';
    return $plugin_array;
}

function  add_tinymce_button($buttons)
{
    $buttons[] = "footnote_shortcode_button";
    return $buttons;
}
