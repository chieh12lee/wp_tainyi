<?php




function custom_posts_per_page($query)
{

    global $post_per_page;
    if ($query->is_tax() || $query->is_category() || $query->is_search()) {
        set_query_var('posts_per_page', $post_per_page);
    }
}
add_action('pre_get_posts', 'custom_posts_per_page');


// add_action('widgets_init', __NAMESPACE__ . '\\register_sidebars');