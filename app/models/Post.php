<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;

class Post extends PostType
{
    public static function init()
    {

        // add_action('widgets_init', array(__CLASS__, 'register_sidebars'));
        add_action('cmb2_admin_init', array(__CLASS__, 'meta_box'));
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

        $prefix = 'post_';
        $mb_id = $prefix . 'basic_';

        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => esc_html__('Setting', 'cmb2'),
            'object_types' => array('post'), // post type

        ));
        $mb->add_field(array(
            'name' => __('Banner'),
            'id' => 'banner',
            // 'desc'    => 'Select ingredients. Drag to reorder.',
            'type' => 'file',

        ));
        $mb->add_field(array(
            'name' => __('Recommends'),
            'id' => 'recommends',
            // 'desc'    => 'Select ingredients. Drag to reorder.',
            'type' => 'pw_multiselect',
            'options' => self::options(),
        ));


        // $prefix = 'post_category_';
        // $mb_id = $prefix . 'basic_';
        // $cmb = new_cmb2_box(array(
        //     'id' => $mb_id,
        //     'title' => esc_html__('Setting', 'cmb2'),
        //     'object_types' => array('term'), // post type
        //     'taxonomies'       => array('category'),
        // ));
    }
};
Post::init();
