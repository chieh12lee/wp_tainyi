<?php

// Bootstrapping theme
require_once __DIR__ . '/app/bootstrap.php';
function my_is_plugin_active($plugin)
{
    return in_array($plugin, (array) get_option('active_plugins', array()));
}

function m($var)
{
    if (current_user_can('edit_posts')) {

        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
function md($var)
{
    if (current_user_can('edit_posts')) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}


add_filter('comment_post_redirect', 'redirect_after_comment', 10, 2);
function redirect_after_comment($location, $comment)
{
    $location = str_replace("#comment-{$comment->comment_ID}", '', $location);

    return $location;
}
function get_the_nav_menu_children_by_post_id($post_id)
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT post_id FROM `wp_posts` p join wp_postmeta m ON p.ID = m.post_id WHERE post_type = 'nav_menu_item' and meta_key = '_menu_item_object_id' and meta_value = $post_id");

    if (count($results)) {
        $result = $results[0];
        if ($result->post_id) {
            $menu_id = $result->post_id;
            $items = $wpdb->get_results("select * from wp_posts where ID in (SELECT meta_value FROM `wp_posts` p join wp_postmeta m on p.ID = m.post_id  WHERE p.ID in (SELECT post_id from wp_postmeta where meta_key = '_menu_item_menu_item_parent' and meta_value = $menu_id) and meta_key = '_menu_item_object_id')");
            return $items;
        }
    }
    return false;
}
