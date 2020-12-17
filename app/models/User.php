<?php

namespace Domo\Models;

use Domo\Models\Blueprints\PostType;
use PostTypes as Cpts;

class User extends PostType
{

    public static function init()
    {

        add_action('cmb2_admin_init', array(__CLASS__, 'meta_box'));
        add_filter( 'option_show_avatars', '__return_false' );
    }

    public static function meta_box()
    {

        $prefix = '';
        $mb_id = $prefix . 'extra_';
        $mb = new_cmb2_box(array(
            'id' => $mb_id,
            'title' => __('設定'),
            'object_types' => array('user'),
        ));

        $mb->add_field(array(
            'name' => 'Avatar',
            'desc' => '',
            'id' => 'avatar',
            'type' => 'file',

        ));
    }
}