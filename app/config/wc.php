<?php

namespace Domo\Wc;

if (!class_exists('woocommerce'))  return;
add_action('after_setup_theme', __NAMESPACE__ . '\\support');

function support()
{

    add_filter('wpgs_post_thumbnail', function () {
        return false;
    });
    add_filter('wpgs_lightbox', function () {
        return true;
    });
    add_filter('wpgs_thumbnials', function () {
        return false;
    });
    // add_theme_support('woocommerce', [
    //     'product_grid' => array('default_columns' => 4),
    // ]);
    // add_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-lightbox');
    // add_theme_support('wc-product-gallery-slider', array());
    // // add_theme_support( 'h-woocommerce' );
    // // add_theme_support( 'h-checkout' );
}
// add_action('loop_start', 'remove_gallery_thumbnail_images');
// add_filter('woocommerce_single_product_image_thumbnail_html', __NAMESPACE__ . '\\remove_featured_image', 10, 2);
function remove_featured_image($html, $attachment_id)
{
    global $post;

    $featured_image = get_post_thumbnail_id($post->ID);

    if ($attachment_id == $featured_image)
        $html = '';

    return $html;
}
