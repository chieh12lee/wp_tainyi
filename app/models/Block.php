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
        $mb_id = $prefix . '_testimony_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('block'),
            'show_on'      => array(
                'key' => 'slug',
                'value' => ['testimony']
            ),
        ));

        $group = $mb->add_field(array(
            'id'          => $mb_id . 'group',
            'type'        => 'group',
            'options'     => array(
                'group_title'   => __('證言', 'domo') . ' {#}', // {#} gets replaced by row number
                'add_button'    => __('新增', 'domo'),
                'remove_button' => __('移除', 'domo'),
                'sortable'      => true, // beta
            ),
        ));

        $mb->add_group_field($group, array(
            'name'    => __('標題', 'domo'),
            'id'      => 'title',
            'type'    => 'text',
        ));
        $mb->add_group_field($group, array(
            'name'    => __('說明', 'domo'),
            'id'      => 'excerpt',
            'type'    => 'textarea',
        ));
        $mb->add_group_field($group, array(
            'name'    => __('圖片', 'domo'),
            'id'      => 'thumbnail',
            'type'    => 'file',
        ));

        $mb_id = $prefix . '_client_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('block'),
            'show_on'      => array(
                'key' => 'slug',
                'value' => ['client'],

            )
        ));

        $mb->add_field(array(
            'name' => 'Logo',
            'desc' => '',
            'id' => 'logo',
            'type' => 'file_list',
        ));
    }
}
