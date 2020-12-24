<?php

namespace Domo\Models;
// namespace Domo\Utils;


use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Slip extends PostType
{
    protected static $post_type = 'slip';
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
                'singular' => __('Slip', 'domo'),
                'plural' => __('Slips', 'domo'),
                'slug' => self::$post_type,
            ],
            [
                'has_archive' => false,
                'supports' => array('title', 'page-attributes', 'thumbnail'),
            ]
        );
        $pt->register();
    }

    public static function meta_box()
    {

        $prefix = '_' . self::$post_type . '_';
        $mb_id = $prefix . 'basic_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('slip'),
        ));


        $mb->add_field(array(
            'name' => __('Pantone', 'cmb2'),
            'id' => 'pantone',
            'type' => 'text',
        ));

        $mb->add_field(array(
            'name' => 'Color',
            'id' => 'color',
            'type' => 'colorpicker',
            'default' => '#ffffff',
        ));
    }
}
