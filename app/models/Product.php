<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Product extends PostType
{
    protected static $post_type = 'product';
    public static function init()
    {
        self::post_type();
        add_action('cmb2_admin_init', array(__CLASS__, 'meta_box'));
    }

    protected static function post_type()
    {

        $pt = new Cpts\PostType(
            [
                'name' => self::$post_type,
                'singular' => __('Product', 'domo'),
                'plural' => __('Product', 'domo'),
                'slug' => self::$post_type,


            ],
            [
                'has_archive' => false,
                // 'rewrite' => array('slug' => 'Product'),

                'supports' => array('title', 'page-attributes', 'thumbnail', 'excerpt'),
            ]
        );
        $pt->register();
        $pt->taxonomy('post_tag');

        $tax_name = self::$post_type . '_category';
        $tax = new Cpts\Taxonomy(
            [
                'name' => $tax_name,

                'singular' => __('Product Category', 'domo'),
                'plural' => __('Product Categories', 'domo'),
                'slug' => $tax_name,
                'hierarchical' => true,
            ],
            array(
                'query_var' => true,
                // 'rewrite' => array('slug' => 'product'),
            )
        );
        $tax->register();

        //組合
        $pt->taxonomy($tax_name);
    }
    public static function options($args = array())
    {

        $posts = self::all($args);
        $options = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $options[$post->ID] = $post->title;
            };
        }
        return $options;
    }
    public static function meta_box()
    {

        $prefix = 'product';
        $mb_id = $prefix . 'basic_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('product'),
        ));


        $mb->add_field(array(
            'name' => 'Gallery',
            'desc' => '',
            'id' => 'gallery',
            'type' => 'file_list',

        ));

        $mb->add_field(array(
            'name' => __('Detail'),
            'desc' => '',
            'id' => 'detail',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Brand'),
            'desc' => '',
            'id' => 'brand',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Size'),
            'desc' => '',
            'id' => 'size',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Material'),
            'desc' => '',
            'id' => 'material',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Recommends'),
            'id' => 'recommends',
            // 'desc'    => 'Select ingredients. Drag to reorder.',
            'type' => 'pw_multiselect',
            'options' => self::options(),

        ));


        $mb_id = $prefix . 'term_';
        $cmb = new_cmb2_box(array(
            'id' =>   $mb_id . 'basic',
            'title' => esc_html__('Setting', 'cmb2'),
            'object_types' => array('term'), // post type
            'taxonomies'       => array('product_category'),
        ));
        $cmb->add_field(array(
            'name' => 'Banner',
            'id' => 'banner',
            'desc' => '列表頁使用的Gallery',
            'type' => 'file_list',
            'preview_size' => array(300, 100), // Default: array( 50, 50 )
            'query_args' => array('type' => 'image'), // Only images attachment
        ));
    }
}
