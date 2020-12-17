<?php

namespace Domo;

// add_image_size('thumbnail-64', 600, 400,true);
add_image_size('square', 600, 600, true);

/**
 * Register a new image size options to the list of selectable sizes in the Media Library
 *
 * @param $sizes
 *
 * @return array
 */
function custom_image_sizes($sizes)
{
    return array_merge($sizes, [
        'square' => __('正方形', 'domo'),
    ]);
}

add_filter('image_size_names_choose',  __NAMESPACE__ . '\custom_image_sizes');
