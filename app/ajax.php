<?php

/**
 * AJAX
 * AJAX Event Handler
 * @class        AJAX
 * @category    Class
 */

namespace domo;

use dowo\AJAX;
use \Routes;
use \Timber;
use Dowo\Helper;

class Ajax_ extends AJAX
{
    public static function init()
    {
        // add_action('wp_ajax_afterAdd2cart',  array(__CLASS__, 'afterAdd2cart'));
        // add_action('wp_ajax_nopriv_afterAdd2cart', array(__CLASS__, 'afterAdd2cart'));
    }


    public static function sender()
    {

        $to = Helper::get_option('option_email');

        $subject =  Helper::get_option('option_name') . ' 網頁郵件';
        $headers[] = 'From: 聯絡郵件 <' . $to . '>';
        $headers[] = 'Cc: admin <chieh.lee@gmail.com>';

        $message = '';
        $message .= (isset($_POST['username'])) ? 'username:' . "\n" . $_POST['username'] . "\n\n" : '';
        $message .= (isset($_POST['company'])) ? 'company:' . "\n" . $_POST['company'] . "\n\n" : '';
        $message .= (isset($_POST['industry'])) ? 'industry:' . "\n" . $_POST['industry'] . "\n\n" : '';
        $message .= (isset($_POST['email'])) ? 'email:' . "\n" . $_POST['email'] . "\n\n" : '';
        $message .= (isset($_POST['phone'])) ? 'phone:' . "\n" . $_POST['phone'] . "\n\n" : '';
        $message .= (isset($_POST['collaborate'])) ? 'username:' . "\n" . $_POST['username'] . "\n\n" : '';
        $message .= (isset($_POST['location'])) ? 'location:' . "\n" . $_POST['location'] . "\n\n" : '';
        $message .= (isset($_POST['budget'])) ? 'budget:' . "\n" . $_POST['budget'] . "\n\n" : '';
        $message .= (isset($_POST['other_budget'])) ? 'other_budget:' . "\n" . $_POST['other_budget'] . "\n\n" : '';


        $msg = wp_mail($to, $subject, $message, $headers);

        if (!empty($msg)) {
            $code = 1;
            $msg = __('成功. ', 'domo');
        } else {
            $code = 400;
            $msg =    __('The server is currently unable to send mail. ', 'domo');
        }

        return self::ajax_return($code, array('msg' => $msg, 'reset' => !empty($sent)));
    }
    public static function ajax_return($code = 200, $data = array())
    {

        $return = array('code' => (string) $code);
        // var_dump(json_encode($return));

        if (!empty($data)) {
            $return['data'] = $data;
        }
        header('Content-Type: application/json');
        die(json_encode($return));
    }
}
Ajax_::init();
// Routes::map('/api/sender', 'Ajax::sender');

Routes::map('/api/sender2', __NAMESPACE__ . '\\Ajax_::sender');
