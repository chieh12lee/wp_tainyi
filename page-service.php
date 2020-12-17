<?php
/* Template Name: Service */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['titles'] = $post->title;

$service_menu = new TimberMenu('service');
$context['service_menu'] = $service_menu->items;

Timber::render(['page/' . $post->post_name . '.twig', 'page/service.twig', $post->post_name . '.twig', 'page.twig'], $context);
