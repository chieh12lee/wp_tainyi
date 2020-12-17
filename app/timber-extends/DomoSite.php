<?php

use Dowo\Helper;

class DomoSite extends TimberSite
{
    /**
     * @var string|void WordPress core url
     */
    public $wp_link;

    public function __construct()
    {
        parent::__construct();
        $this->wp_link = site_url();
        $this->link = home_url();
        $this->logo = [
            'normal' => Helper::get_option('option_logo'),
            'dark' => Helper::get_option('option_logo_dark'),
            'light' => Helper::get_option('option_logo_light'),
        ];
        $this->info = [
            'business' => Helper::get_option('option_business'),
            'skype' => Helper::get_option('option_skype'),
            'company_name' => Helper::get_option('option_name'),
            'tel' => Helper::get_option('option_tel'),
            'email' => Helper::get_option('option_email'),
            'address' => Helper::get_option('option_address'),
            // 'fax' => Helper::get_option('option_fax'),

        ];
        // $this->contact_link = Helper::get_option('contact_link');
        // $this->banner = ['src' => Helper::get_option('option_banner')];
        $this->socials = [
            'facebook' => [
                'type' => 'facebook',
                'url' => Helper::get_option('option_facebook'),

            ],
            'line' => [
                'type' => 'line',
                'url' => Helper::get_option('option_line'),

            ],
            'instagram' => [
                'type' => 'instagram',
                'url' => Helper::get_option('option_instagram'),

            ],

        ];
    }
}
