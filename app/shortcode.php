<?php

use Domo\Models;

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


add_shortcode('ribbon', 'ribbon');
function ribbon($atts)
{

  $context['class'] = isset($atts['class']) ? $atts['class'] : '';
  $context['style'] = isset($atts['style']) ? $atts['style'] : '';
  $context['animate'] = isset($atts['animate']) ? $atts['animate'] : false;
  $context['type'] = isset($atts['type']) ? $atts['type'] : 'normal';
  $context['width'] = isset($atts['class']) ? $atts['class'] : '';

  if (isset($atts['width'])) {
    $context['width']  = $atts['width'];
  } else {
    if (isset($atts['type'])  && $atts['type'] === 'small') {
      $context['width'] = 58;
    } else {

      $context['width'] = 170;
    }
  }

  $html  =  Timber::compile('@cmpt/ribbon/ribbon.twig', $context);

  return $html;
};
