<?php

use Domo\Models\Product;
use Domo\Models\Post;

$context = Timber::get_context();
$post = new TimberPost();
$context['row'] = $post;
$context['cancel_link'] = get_cancel_comment_reply_link(__('Cancel reply', 'base-camp'));
// 前後業的
$next_post = get_previous_post();
if (is_a($next_post, 'WP_Post')) {
    // $context['next'] = get_permalink($next_post->ID);
    $context['next'] = ['link' => get_permalink($next_post->ID), 'title' => $next_post->post_title];
}

$prev_post = get_next_post();
if (is_a($prev_post, 'WP_Post')) {
    $context['prev'] = ['link' => get_permalink($prev_post->ID), 'title' => $prev_post->post_title];
}

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    $post_type = $post->post_type === 'revision' ? get_post_type($post->post_parent) : $post->post_type;

    if ($post_type === 'product') {
        if ($post->recommends) {
            $context['recommends'] =  Product::inc($post->recommends)->get();
        }
    } else {


        $terms =  $post->terms(array(
            'query' => [
                'taxonomy' => 'category'
            ],
        ));
        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                // only do if parent is 0 (top most)
                if ($term->parent == 0) {
                    $root_term = $term;
                }
            }
        }
        if ($post->recommends) {
            $context['recommends'] =  Post::inc($post->recommends)->get();
        }


        // $context['banner'] =  ['src' => $post->banner, 'alt' => $post->post_title];
    }





    Timber::render(['single-' . $post->ID . '.twig', 'single-' . $post_type . '.twig', 'single.twig'], $context);
}
