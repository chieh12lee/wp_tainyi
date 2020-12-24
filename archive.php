<?php

use Dowo\Helper;
use Dowo\Sidebar;

$templates = ['archive.twig', 'index.twig'];
$context = Timber::get_context();
$context['titles'] = 'Archive';
$post_type =  get_post_type();

$query = get_queried_object();
$args = [
    'posts_per_page' => $post_per_page,
    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    'post_type' => $post_type,
];

if (is_day()) {
    $context['titles'] = 'Archive: ' . get_the_date('D M Y');
} elseif (is_month()) {
    $context['titles'] = 'Archive: ' . get_the_date('M Y');
} elseif (is_year()) {
    $context['titles'] = 'Archive: ' . get_the_date('Y');
} elseif (is_tag()) {
    $context['titles'] = 'Tag: ' . single_tag_title('', false);
} elseif (is_category() || is_tax()) {


    $term_id = $query->term_id;
    $term =  new Timber\Term($term_id);
    $taxonomy = $query->taxonomy;


    $root_ids = array_reverse(get_ancestors($term_id, $taxonomy));
    $root_id = count($root_ids) > 0 ? $root_ids[0] : $term_id;
    $root_term = new Timber\Term($root_id);




    // $context['terms']  = Timber::get_terms([
    //     'taxonomy' => $taxonomy,
    //     'child_of' =>  $root_id,
    //     'title_li' => '',
    //     'echo' => false,
    //     'hide_empty' => false,
    //     'show_option_none'   => false,
    // ]);

    $sidebar_args = [
        'titles' => $root_term->name,
        'child_of' => $root_term->ID,
        // 'cls' => 'submenu --stacked',
        'child_of_fake_tax' =>  true,
        'hide_empty' =>  true,
        'tree' => false
    ];

    // 取得
    $args['tax_query'] = ['relation' => 'AND'];
    $args['tax_query'][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'id',
        'terms'    =>  [$term_id],
        'include_children' => true
    );
    array_unshift($templates, 'archive-' . get_post_type() . '.twig');


    if ($post_type === 'product') {

        $sidebar_args['titles'] = __('產品分類', 'domo');
        $sidebar_args['depth'] = 2;

        foreach ($term->banner as $key => $value) {
            $context['products_banners'][] = new Timber\Image($key);
        }
    } else {
        $sidebar_args['titles'] = '';
    }
    $context['titles'] =  $term->name;
    $context['sidebar'] = Sidebar::render($sidebar_args);


    $context['posts'] = new Timber\PostQuery($args);

    $context['pagination'] = Timber::get_pagination(array());
} elseif (is_post_type_archive()) {


    $context['titles'] = $query->label;

    array_unshift($templates, 'archive-' . get_post_type() . '.twig');
    $context['posts'] = new Timber\PostQuery($args);
    $context['pagination'] = Timber::get_pagination(array());
}




Timber::render($templates, $context);
