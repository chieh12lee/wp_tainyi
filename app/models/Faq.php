<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Faq extends PostType
{
    protected static $post_type = 'faq';
    public static function init()
    {

        self::post_type();
    }

    protected static function post_type()
    {

        $pt = new Cpts\PostType(
            [
                'name' => self::$post_type,
                'singular' => __('Faq', 'domo'),
                'plural' => __('Faq', 'domo'),
                'slug' => self::$post_type,
            ],
            [
                'has_archive' => true,
                'supports' => array('title', 'editor', 'page-attributes'),
            ]
        );
        $pt->register();

        // $tax_name = self::$post_type . '_category';
        // $tax = new Cpts\Taxonomy(
        //     [
        //         'name' => $tax_name,

        //         'singular' => __('Faq Category', 'domo'),
        //         'plural' => __('Faq Category', 'domo'),
        //         'slug' => $tax_name,
        //         'hierarchical' => true,
        //     ],
        //     array(
        //         'query_var' => true,
        //         'rewrite' => array('slug' => 'faq'),
        //     )
        // );
        // $tax->register();

        // //組合
        // $pt->taxonomy($tax_name);
    }
}
