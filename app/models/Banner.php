<?php

namespace Domo\Models;
// namespace Domo\Utils;


use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class Banner extends PostType
{
    protected static $post_type = 'banner';
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
                'singular' => __('Banner', 'domo'),
                'plural' => __('Banner', 'domo'),
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
            'object_types' => array('banner'),
        ));

        // $mb->add_field(array(
        //     'name' => __('大標題', 'cmb2'),
        //     'id' => 'titles',
        //     'type' => 'text',
        // ));
        // $mb->add_field(array(
        //     'name' => __('Subtitle', 'cmb2'),
        //     'id' => 'subtitle',
        //     'type' => 'text',
        // ));
        // $mb->add_field(array(
        //     'name' => 'Image',
        //     'desc' => '',
        //     'id' => 'desktop',
        //     'type' => 'file',

        // ));
        // $mb->add_field(array(
        //     'name' => 'Mobile Image',
        //     'desc' => '',
        //     'id' => 'mobile',
        //     'type' => 'file',

        // ));
        $mb->add_field(array(
            'name' => 'Test Color Picker',
            'id' => 'wiki_test_colorpicker',
            'type' => 'colorpicker',
            'default' => '#ffffff',
        ));

        // $mb->add_field(array(
        //     'name' => __('Link', 'cmb2'),
        //     'id' => 'link2',
        //     'type' => 'text_url',
        //     // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
        // ));
        // $mb->add_field(array(
        //     'name' => '另開方式',
        //     'id' => 'target',
        //     'type' => 'select',
        //     'default' => '_self',
        //     'options' => array(
        //         '_self' => __('換頁', 'cmb2'),
        //         '_blank' => __('另開', 'cmb2'),
        //     ),
        // ));
        // $mb->add_field(array(
        //     'name' => __('上下架時間', 'cmb2'),
        //     'desc' => __('field description (optional)', 'cmb2'),
        //     'id' => $prefix . 'daterange',
        //     'type' => 'date_range',
        // ));
        $mb->add_field(array(
            'name' => '位置',
            'id' => 'pos',
            'type' => 'select',
            'default' => 'home',
            'options' => array(
                'home' => __('首頁', 'cmb2'),
                // '_blank' => __('另開', 'cmb2'),

            ),
        ));
    }
}
