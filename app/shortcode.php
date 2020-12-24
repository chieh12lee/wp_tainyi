<?php

// use Domo\Models;

add_shortcode('site_info', 'site_info');

function site_info()
{
  $timber_context = Timber::get_context();

  $context = [
    'info' => $timber_context['site']->info,
    'has_icon' => true
  ];

  $html  =  Timber::compile('@core/cmpt/info/info.twig', $context);

  return $html;
}
