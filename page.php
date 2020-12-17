<?php

use Domo\Models;
// use Domo\Helper;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['titles'] = $post->title;
$context['subtitle'] = $post->post_excerpt;


// if ($post->post_parent > 0) {
//     $sidebar = Timber::get_posts([
//         "post_type" => 'page',
//         'post_parent'    => $post->post_parent,
//     ]);

//      $context['press']

//     md($sidebar);
// }


switch ($post->post_name) {

    case 'contact':

        break;
    case 'about':
        $context['locations']  =  Models\Company::orderby('menu_order')->get();
        $context['client'] = Timber::get_post('client');
        $context['certification'] = Timber::get_post('certification');
        break;
    case 'home':


        $context['banners'] =  Models\Banner::all();
        $context['new_products'] = Timber::get_posts([
            'post_type' => 'product',
            'order_by' => 'menu_order',

            'posts_per_page' => 2,
            'post_status'    => 'publish',
        ]);
        $context['client'] = Timber::get_post('client');
        $context['locations']  =  Models\Company::orderby('menu_order')->get();

        break;


    default:
        # code...
        break;
}

Timber::render(['page/' . $post->post_name . '.twig', $post->post_name . '.twig', 'page.twig'], $context);
