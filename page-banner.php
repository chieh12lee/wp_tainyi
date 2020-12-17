<?php
/* Template Name: Service */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['titles'] = $post->title;



Timber::render(['page/' . $post->post_name . '.twig', 'page/page-banner.twig', $post->post_name . '.twig', 'page.twig'], $context);
