<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Company extends PostType
{
    protected static $post_type = 'company';
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
                'singular' => __('Company', 'domo'),
                'plural' => __('Companies', 'domo'),
                'slug' => self::$post_type,
            ],
            [
                'has_archive' => false,
                'supports' => array('title',  'page-attributes'),
            ]
        );
        $pt->register();
        // $pt->taxonomy('post_tag');
    }
    public static function meta_box()
    {

        $prefix = 'company';
        $mb_id = $prefix . 'basic_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('Setting'),
            'object_types' => array('company'),
        ));

        $mb->add_field(array(
            'name' => __('Tel'),
            'id' => 'tel',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Address'),
            'id' => 'address',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => __('Business'),
            'id' => 'business',
            'type' => 'text',
        ));
        $mb->add_field(array(
            'name' => 'Google map ',
            'desc' => '請直接貼入google embed code',
            'id' => 'map',
            'type' => 'textarea_code',
        ));
    }
}
