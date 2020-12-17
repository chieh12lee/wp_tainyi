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
                'singular' => __('Showcase', 'domo'),
                'plural' => __('Showcases', 'domo'),
                'slug' => self::$post_type,


            ],
            [
                'has_archive' => true,
                'rewrite' => array('slug' => 'showcase'),

                'supports' => array('title', 'page-attributes', 'thumbnail', 'excerpt'),
            ]
        );
        $pt->register();
        $pt->taxonomy('post_tag');
    }
    public static function options($args = array())
    {

        $posts = self::all($args);
        $options = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $options[$post->ID] = $post->post_name;
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
            'name' => 'Color',
            'desc' => '',
            'id' => 'color',
            'type' => 'select',
            'options'          => array(
                'pink' => __('Pink', 'domo'),
                'yellow'   => __('Yellow', 'domo'),
                'blue'     => __('Blue', 'domo'),
                'black'     => __('Black', 'domo'),
            ),


        ));
        $mb->add_field(array(
            'name' => 'banner',
            'desc' => '',
            'id' => 'banner',
            'type' => 'file',

        ));
        $mb->add_field(array(
            'name' => 'pic_1',
            'desc' => '',
            'id' => 'pic_1',
            'type' => 'file',

        ));
        $mb->add_field(array(
            'name' => 'pic_2',
            'desc' => '',
            'id' => 'pic_2',
            'type' => 'file',

        ));
        $mb->add_field(array(
            'name' => 'pic_3',
            'desc' => '',
            'id' => 'pic_3',
            'type' => 'file',

        ));
        $mb->add_field(array(
            'name' => 'pic_4',
            'desc' => '',
            'id' => 'pic_4',
            'type' => 'file',

        ));

        $mb->add_field(array(
            'name' => __('Challenges'),
            'desc' => '標題簡介的下方主要說明',
            'id' => 'challenges',
            'type' => 'textarea',
        ));
        $mb->add_field(array(
            'name' => __('Solution'),
            'desc' => '標題簡介的下方主要說明',
            'id' => 'solution',
            'type' => 'textarea',
        ));
        $mb->add_field(array(
            'name' => __('Result'),
            'desc' => '標題簡介的下方主要說明',
            'id' => 'result',
            'type' => 'textarea',
        ));

        $mb->add_field(array(
            'name' => __('Recommends'),
            'id' => 'recommends',
            // 'desc'    => 'Select ingredients. Drag to reorder.',
            'type' => 'pw_multiselect',
            'options' => self::options(),

        ));
    }
}
