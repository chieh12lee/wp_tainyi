<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Block extends PostType
{
    protected static $post_type = 'block';
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
                'singular' => __('Block', 'domo'),
                'plural' => __('Blocks', 'domo'),
                'slug' => self::$post_type,


            ],
            [
                'has_archive' => false,


                'supports' => array('title'),
            ]
        );
        $pt->register();
    }

    public static function meta_box()
    {

        $prefix = 'block';
        $mb_id = $prefix . 'basic_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('block'),
        ));



        $mb->add_field(array(
            'name' => 'List',
            'desc' => '',
            'id' => 'items',
            'type' => 'file_list',
        ));
    }
}
