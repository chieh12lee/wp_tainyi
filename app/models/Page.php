<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;

class Page extends PostType
{
    protected static $post_type = 'page';
    public static function init()
    {
        add_action('cmb2_admin_init', array(__CLASS__, 'meta_box'));
    }


    public static function meta_box()
    {

        $prefix = '_' . self::$post_type . '_';
        $mb_id = $prefix . 'basic_';
        // $mb = new_cmb2_box(array(
        //     'id' => $mb_id,
        //     'title' => __('設定'),
        //     'object_types' => array('page'),
        //     'show_on'      => array('key' => 'slug', 'value' => ['home']),
        // ));

        // $mb->add_field(array(
        //     'name' => '首頁上方連結',
        //     'id' => 'link2',
        //     'type' => 'text_url',
        //     // 'timezone_meta_key' => 'wiki_test_timezone',
        // ));
        // $mb_id = $prefix . 'map_';
        // $mb = new_cmb2_box(array(
        //     'id' => $mb_id,
        //     'title' => __('設定'),
        //     'object_types' => array('page'),
        //     'show_on'      => array('key' => 'slug', 'value' => ['contact']),
        // ));

    }
}
