<?php

use Domo\Utils\Session;
use Domo\Models;

if (!class_exists('Dowo')) die('Dowo plugin required');
// Load all theme composer packages
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/autoload.php';
require_once __DIR__ . '/../app/shortcode.php';
require_once __DIR__ . '/migrate.php';
require_once __DIR__ . '/ajax.php';
// require_once __DIR__ . '/exts/tinymice/tinymice.php';
require_once __DIR__ . '/exts/post-gallery/post-gallery.php';
// Init Sessions
Session::init();

// Init posttypes

Models\Page::init();

// Models\Banner::init();
Models\Faq::init();
Models\Block::init();
Models\Product::init();
Models\Slip::init();
Models\Post::init();
// Models\Company::init();
Models\Site::get_instance();

// // remove_filter('the_content', 'wpautop');
// remove_filter('the_excerpt', 'wpautop');
function localize()
{

    load_theme_textdomain('domo', get_template_directory() . '/src/languages');
}

add_action('after_setup_theme', 'localize');

/**
 * Add Mime Types
 */
function bodhi_svgs_upload_mimes($mimes = array())
{

    global $bodhi_svgs_options;

    if (empty($bodhi_svgs_options['restrict']) || current_user_can('administrator')) {

        // allow SVG file upload
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';

        return $mimes;
    } else {

        return $mimes;
    }
}
add_filter('upload_mimes', 'bodhi_svgs_upload_mimes', 99);

/**
 * Check Mime Types
 */
function bodhi_svgs_upload_check($checked, $file, $filename, $mimes)
{

    if (!$checked['type']) {

        $check_filetype        = wp_check_filetype($filename, $mimes);
        $ext                = $check_filetype['ext'];
        $type                = $check_filetype['type'];
        $proper_filename    = $filename;

        if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
            $ext = $type = false;
        }

        $checked = compact('ext', 'type', 'proper_filename');
    }

    return $checked;
}
add_filter('wp_check_filetype_and_ext', 'bodhi_svgs_upload_check', 10, 4);

/**
 * Mime Check fix for WP 4.7.1 / 4.7.2
 *
 * Fixes uploads for these 2 version of WordPress.
 * Issue was fixed in 4.7.3 core.
 */
function bodhi_svgs_allow_svg_upload($data, $file, $filename, $mimes)
{

    global $wp_version;
    if ($wp_version !== '4.7.1' || $wp_version !== '4.7.2') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext'                => $filetype['ext'],
        'type'                => $filetype['type'],
        'proper_filename'    => $data['proper_filename']
    ];
}
add_filter('wp_check_filetype_and_ext', 'bodhi_svgs_allow_svg_upload', 10, 4);
/**
 * Removes metabox from appearing on post new screens before the post
 * ID has been set.
 *
 * @author Thomas Griffin
 *
 * @param bool $display
 * @param array $meta_box The array of metabox options
 * @return bool $display True on success, false on failure
 */
function tgm_exclude_from_new($display, $meta_box)
{

    if (!isset($meta_box['show_on']['alt_key'], $meta_box['show_on']['alt_value'])) {
        return $display;
    }

    global $pagenow;

    // Force to be an array
    $to_exclude = !is_array($meta_box['show_on']['alt_value'])
        ? array($meta_box['show_on']['alt_value'])
        : $meta_box['show_on']['alt_value'];

    $is_new_post = 'post-new.php' == $pagenow && in_array('post-new.php', $to_exclude);


    return !$is_new_post;
}
add_filter('cmb2_show_on', 'tgm_exclude_from_new', 10, 2);
