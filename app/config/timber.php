<?php

use  Dowo\Helper;
// use  Dowo\Sidebar;
/*
|--------------------------------------------------------------------------
| Pagination mid size
|--------------------------------------------------------------------------
|
| Here you can define that how many pagination items there are before and after current
| pagination item in pagination list. First and last item are always visible.
|
| For example:
| $pagination_mid_size = 1 => 1 ... 5 [6] 7 ... 11
| $pagination_mid_size = 2 => 1 ... 4 5 [6] 7 8 ... 11
| $pagination_mid_size = 3 => 1 ... 3 4 5 [6] 7 8 9 ... 11
| $pagination_mid_size = H3 => 1 2 3 4 [5] 6 7 8 ... 11
|
| Supported Mid size value: 1 - n
|
 */

$post_per_page = 9;
$pagination_mid_size = 2;

$pagination_mid_size += 2; // DON'T TOUCH


/**
 * Adds data to Timber conteixt.
 *
 * @param $data
 *
 * @return mixed
 */
function add_to_context($context)
{

    $main_menu = new TimberMenu('main');

    $context['header_menu'] = $main_menu->items;

    $footer_menu = new TimberMenu('footer');
    $context['footer_menu'] = $footer_menu->items;
    // Add main-sidebar to Timber context object
    // $context['main_sidebar'] =   Timber::get_widgets('main-sidebar');




    $context['logo'] = Helper::images_path('logo.png');
    $context['logo_dark'] = Helper::images_path('logo-dark.png');


    // Extend TimberSite object
    $context['site'] = new DomoSite();
    $context['banner'] =  $context['site']->banner;


    return $context;
}

add_filter('timber_context', 'add_to_context');
