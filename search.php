<?php

$templates             = ['search.twig', 'archive.twig', 'index.twig'];
$context               = Timber::get_context();
$context['titles']      = __('搜尋條件 : ','domo') . get_search_query();




$args = [
    'posts_per_page' => $post_per_page,
    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    'post_type' => ['post','partner'],
    's'=> get_query_var('s'),
    'post_status'    => 'publish',

];
$context['posts'] = new Timber\PostQuery($args);

// $context['pagination'] = Timber::get_pagination($pagination_mid_size);

$context['pagination'] = Timber::get_pagination($pagination_mid_size);
$context['pagination']['per'] = $post_per_page;

Timber::render($templates, $context);