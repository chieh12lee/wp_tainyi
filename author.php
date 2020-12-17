<?php

global $wp_query;
$templates             = ['author.twig', 'archive.twig'];
$context               = Timber::get_context();
$context['posts']      = new Timber\PostQuery();
$context['pagination'] = Timber::get_pagination($pagination_mid_size);
// Check if author exists
if (isset($wp_query->query_vars['author'])) {
    $author            = new TimberUser($wp_query->query_vars['author']);
    $context['author'] = $author;
     $context['card_mode'] ='normal';
    $context['thumbnail_size'] ='thumbnail-64';
    $context['titles']  = __('作者 / ','domo') . $author->name();
    $context['loopbar'] =false;;
}
Timber::render($templates, $context);