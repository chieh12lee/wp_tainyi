<?php

Routes::map('/api/migrate', 'Migrate::init');
// Migrate::init();
class Migrate
{

    public static function set_pages()
    {


        $pages = [
            'home' => 'Home',
            'about' => 'About',
            'service' => 'Service',
            'green' => 'Green',
            'contact' => 'Contact',
        ];
        foreach ($pages as $key => $value) {

            $post_exists =   get_page_by_path($key, OBJECT, 'page');

            if (!$post_exists) {
                $id =    wp_insert_post(array(
                    'post_name'    => sanitize_title($key),
                    'post_title' => $value,
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'   => 'page',
                    'no_found_rows' => true
                ));
                if ($key === 'home') {
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $id);
                }
            }
        }
    }
    public static function set_cats()
    {
        // $cats = [
        //     'news' => [
        //         'title' => '最新消息',
        //         'children' => [
        //             'reputation ' => [
        //                 'title' => '真實口碑'
        //             ],
        //             'exhibition' => [
        //                 'title' => '參展資訊'
        //             ],
        //             'press' => [
        //                 'title' => '媒體報導'
        //             ],
        //             'info' => [
        //                 'title' => '商品資訊'
        //             ]
        //         ]
        //     ]
        // ];

        $cats = [
            'press' => [
                'title' => 'Blog',
                'children' => [
                    'news' => [
                        'title' => 'NEWS'
                    ],
                    'work' => [
                        'title' => 'WORK'
                    ],
                    'event' => [
                        'title' => 'EVENT'
                    ],
                    'other' => [
                        'title' => 'OTHER'
                    ]
                ]
            ]
        ];

        foreach ($cats as $key => $value) {
            if (!term_exists($key, 'category')) {
                $term =   wp_insert_term(
                    $value['title'],
                    'category',
                    array(
                        'slug' => $key,
                    )
                );

                if (isset($value['children'])) {
                    foreach ($value['children'] as $ckey => $cvalue) {
                        $subterm = wp_insert_term(
                            $cvalue['title'],
                            'category',
                            array(
                                'parent' => $term['term_id'],
                                'slug' => $ckey,
                            )
                        );
                        for ($i = 1; $i < 6; $i++) {
                            $post_ID  =   wp_insert_post(array(
                                'post_name'    => sanitize_title('Article test'),
                                'post_title' => '測試文章',
                                'post_status'   => 'publish',
                                'post_author'   => 1,
                                'post_type'   => 'post',
                                'post_category' => [$term['term_id'], $subterm['term_id']]

                            ));

                            set_post_thumbnail($post_ID, 5);
                        }
                    }
                }
            }
        }
    }




    public static function custom_permalinks()
    {
        global $wp_rewrite;
        $wp_rewrite->page_structure = $wp_rewrite->root . '/%pagename%/'; // custom page permalinks
        $wp_rewrite->set_permalink_structure($wp_rewrite->root . '/%postname%/'); // custom post permalinks
    }

    public static  function menu()
    {


        $menuname = 'main';
        $menu_location = 'main_menu';
        // Does the menu exist already?
        $menu_exists = wp_get_nav_menu_object($menuname);

        // If it doesn't exist, let's create it.
        if (!$menu_exists) {
            $menu_id = wp_create_nav_menu($menuname);

            // Set up default BuddyPress links and add them to the menu.
            // wp_update_nav_menu_item($menu_id, 0, array(
            //     'menu-item-title' =>  __('Home'),
            //     'menu-item-classes' => 'home',
            //     'menu-item-url' => home_url('/'),
            //     'menu-item-status' => 'publish'
            //       'menu-item-object' => 'page',
            // ));



            // Grab the theme locations and assign our newly-created menu
            // to the BuddyPress menu location.
            if (!has_nav_menu($menu_location)) {
                $locations = get_theme_mod('nav_menu_locations');
                $locations[$menu_location] = $menu_id;
                set_theme_mod('nav_menu_locations', $locations);
            }
        }
    }


    public static  function init()
    {

        if (\WP_ENV === 'production') die('not allow');


        add_action('init', [__CLASS__, 'set_pages']);
        add_action('init',  [__CLASS__, 'set_cats']);
        // add_action('init',  [__CLASS__, 'set_faq']);
        add_action('init', [__CLASS__, 'custom_permalinks']);

        update_option('uploads_use_yearmonth_folders ', 0);
        update_option('thumbnail_size_w ', 580);
        update_option('thumbnail_size_y ', 360);
        update_option('medium_size_w ', 800);
        update_option('medium_size_h ', 800);
        update_option('large_size_w ', 1680);
        update_option('large_size_h ', 1024);

        // update_option('uploads_use_yearmonth_folders ', 0);
        if (class_exists('woocommerce')) {
            add_action('init',  [__CLASS__, 'set_wc_cats']);
            # code...
            // not working 這三個
            // update_option('woocommerce_enable_myaccount_registration', true);
            // update_option('woocommerce_enable_signup_and_login_from_checkout', true);
            // update_option('woocommerce_enable_checkout_login_reminder', 1);

            update_option('woocommerce_ship_to_destination ', 'shipping');
            update_option('woocommerce_enable_shipping_calc ', false);
            update_option('woocommerce_manage_stock ', true);
            update_option('woocommerce_hold_stock_minutes', 0);
            update_option('woocommerce_store_address', '');
            update_option('woocommerce_allowed_countries', 'specific');
            update_option('woocommerce_default_country', 'TW:台北市');
            update_option('woocommerce_specific_allowed_countries', ['TW']);
            update_option('woocommerce_currency', 'TWD');
            update_option('woocommerce_price_num_decimals', 0);
            update_option('woocommerce_hold_stock_minutes', 0);
        }
        return 'done';
    }
}
