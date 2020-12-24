<?php

use Domo\Models;
// use Domo\Helper;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['titles'] = $post->title;
$context['subtitle'] = $post->post_excerpt;
if ($post->banner) {
    foreach ($post->banner as $key => $value) {

        $context['page_banners'][] = new Timber\Image($key);
    }
}


// if ($post->post_parent > 0) {
//     $sidebar = Timber::get_posts([
//         "post_type" => 'page',
//         'post_parent'    => $post->post_parent,
//     ]);

//      $context['press']

//     md($sidebar);
// }


switch ($post->post_name) {

    case 'introdution':
        $context['cloths'] =  Models\Slip::all();
        break;
    case 'contact':

        break;
    case 'about':
        // $context['locations']  =  Models\Company::orderby('menu_order')->get();
        $client =  Timber::get_post('client');
        $context['clients'] = $client->logo;
        // $context['certification'] = Timber::get_post('certification');
        break;
    case 'home':

        // $context['post']->banner; 
        $testimony = Timber::get_post('testimony');

        foreach ($testimony->block_testimony_group as $testimony) {

            $item = [
                "title" => $testimony['title'],
                "excerpt" => $testimony['excerpt'],
                "thumbnail" => new Timber\Image($testimony['thumbnail_id'])
            ];
            $context['testimonies'][] = $item;
        }

        // $context['home_banners'] = $post->banner;
        // $context['home_banners']

        // md($context['home_banners']);


        // $context['new_products'] = Timber::get_posts([
        //     'post_type' => 'product',
        //     'order_by' => 'menu_order',

        //     'posts_per_page' => 2,
        //     'post_status'    => 'publish',
        // ]);
        // $context['client'] = Timber::get_post('client');

        // $context['locations']  =  Models\Company::orderby('menu_order')->get();

        break;


    default:
        # code...
        break;
}

Timber::render(['page/' . $post->post_name . '.twig', $post->post_name . '.twig', 'page.twig'], $context);
