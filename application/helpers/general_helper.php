<?php

if (!function_exists('error_res'))
{

    function error_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "query_fail" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 0, 'msg' => $msg);
    }

}

if (!function_exists('success_res'))
{

    function success_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "query_ok" : $msg;
        $msg = "success_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 1, 'msg' => $msg);
    }

}

if (!function_exists('sql_error_res'))
{

    function sql_error_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "sql_error" : $msg;
        $msg = "db_error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 3, 'msg' => $msg);
    }

}

if (!function_exists('spamer_res'))
{

    function spamer_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "too_much_attempt" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 6, 'msg' => $msg);
    }

}

if (!function_exists('req_token_missing_res'))
{

    function req_token_missing_res($msg = "", $args = array())
    {

        $CI = & get_instance();
        $msg = $msg == "" ? "request_token_invalid" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 7, 'msg' => $msg);
    }

}


if (!function_exists('auth_token_missing_res'))
{

    function auth_token_missing_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "auth_token_invalid" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 8, 'msg' => $msg);
    }

}

if (!function_exists('new_request_token_res'))
{

    function new_request_token_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "new_request_token" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 9, 'msg' => $msg);
    }

}

if (!function_exists('captcha_error_res'))
{

    function captcha_error_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "captcha" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 10, 'msg' => $msg);
    }

}

if (!function_exists('validation_error_res'))
{

    function validation_error_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "validation_error" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 11, 'msg' => $msg);
    }

}

if (!function_exists('pop_up_res'))
{

    function pop_up_res($msg = "", $args = array())
    {
        $CI = & get_instance();
        $msg = $msg == "" ? "email_not_verified" : $msg;
        $msg = "error_" . $msg;
        $converted = $CI->lang->line($msg);
        $msg = $converted == "" ? $msg : $converted;
        $msg = vsprintf($msg, $args);
        return array('statuscode' => 12, 'msg' => $msg);
    }

}



function _e($data)
{
    $CI = & get_instance();
    $CI->output->_display();
    if (is_array($data) || is_object($data))
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    else
    {
        echo $data;
    }
}

function send_email($to, $subject, $body, $from = "", $from_name = "")
{
    if (is_development())
        return true;

    $CI = &get_instance();

    $from = $from == "" ? INFO_EMAIL : $from;
    $from_name = $from_name == "" ? PLATFORM_NAME : $from_name;
    $header = "Reply-To: " . $from_name . " <" . $from . ">\r\n";
    $header .= "Return-Path: " . $from_name . " <" . $from . ">\r\n";
    $header .= "From: " . $from_name . " <" . $from . ">\r\n";
    $header .= "Organization: " . PLATFORM_NAME . "\r\n";
    $header .= "Content-Type: text/html\r\n";

    return mail($to, $subject, $body, $header, "-f " . $from);
}

if (!function_exists('write_log'))
{

    function write_log($file_name = "", $msg = "")
    {
        if ($msg == "")
            return FALSE;
        $file_name = $file_name == "" ? date("Y-m-d") : $file_name;
        $fp = fopen("my_logs/" . $file_name . ".txt", "a+");
        fwrite($fp, date("Y-m-d H:i:s") . ": " . $msg . "\r\n");
        fclose($fp);
    }

}


if (!function_exists('is_assoc'))
{

    function is_assoc($arr)
    {
        if (is_array($arr))
        {
            return array_keys($arr) !== range(0, count($arr) - 1);
        }
        return FALSE;
    }

}

function is_production()
{
    if (ENVIRONMENT == "production")
    {
        return TRUE;
    }
    return FALSE;
}

function is_development()
{
    if (ENVIRONMENT == "development")
    {
        return TRUE;
    }
    return FALSE;
}

function is_testing()
{
    if (ENVIRONMENT == "testing")
    {
        return TRUE;
    }
    return FALSE;
}

function ip()
{
    $CI = & get_instance();
    $ip = $CI->input->server("REMOTE_ADDR");
//    if (is_development())
//        $ip = $CI->mylib->get_external_ip();

    return $ip;
}

function _url($str)
{
    return parse_url($str);
}

function _email($str)
{
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function response($data)
{
    $CI = & get_instance();
    if (is_array($data))
    {
        $CI->output->set_content_type('application/json');
        if (isset($_POST['monitor']) || isset($_GET['monitor']))
            $data['execution_time'] = get_execution_time();
        $res = json_encode($data);
    }
    else
    {
        $res = $data;
    }
    $CI->output->_display($res);
    exit;
}

function get_execution_time()
{
    $CI = & get_instance();
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $finish = $time;
    $total_time = round(($finish - $CI->start_time), 4);
    return $total_time;
}

function get_default_fields($defult_fields)
{
    $new_default = array();
    foreach ($defult_fields as $key => $val)
    {
        $new_default[$key] = $defult_fields[$key]['default'];
    }
    return $new_default;
}

function get_default_meta_fields($defult_fields)
{
    $new_default = array();
    foreach ($defult_fields as $val)
    {
        $new_default[$val['meta_key']] = array("autoload" => $val['autoload'], "value" => $val['default']);
    }
    return $new_default;
}

function check_and_create_directory($dir_path)
{
    if (!file_exists($dir_path))
    {
        mkdir($dir_path, 0777);
        mkdir($dir_path . "/cache");
    }
    return TRUE;
}

if (!function_exists('random_str'))
{

    function random_str($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

function filter_data_to_api($default_fields, $actual_data)
{
    foreach ($default_fields as $key => $val)
    {
        if (isset($actual_data[$key]))
        {
            if ($val['protected'] == 1)
                unset($actual_data[$key]);
        }
    }
    return $actual_data;
}

function date_difference($start, $end, $type = "s")
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $diff = $start->diff($end);
    $diff_sec = $diff->format('%r') . ( // prepend the sign - if negative, change it to R if you want the +, too
            ($diff->s) + // seconds (no errors)
            (60 * ($diff->i)) + // minutes (no errors)
            (60 * 60 * ($diff->h)) + // hours (no errors)
            (24 * 60 * 60 * ($diff->d)) + // days (no errors)
            (30 * 24 * 60 * 60 * ($diff->m)) + // months (???)
            (365 * 24 * 60 * 60 * ($diff->y)) // years (???)
            );
    if ($type == "s")
        $actual_diff = $diff_sec;
    else if ($type == "i")
        $actual_diff = (float) ($diff_sec / 60);
    else if ($type == "h")
        $actual_diff = (float) ($diff_sec / 60 / 60);
    else if ($type == "d")
        $actual_diff = (float) ($diff_sec / 60 / 60 / 24);
    else if ($type == "m")
        $actual_diff = (float) ($diff_sec / 60 / 60 / 24 / 30);
    else if ($type == "y")
        $actual_diff = (float) ($diff_sec / 60 / 60 / 24 / 30 / 12);
    return $actual_diff;
}

function get_city_by_google_map($lat, $long)
{
	print_r($lat);
	$city_name = "";
    $address_json_str = file_get_contents(sprintf("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCNMGo8cmjsPovFnkWdUO4mmEk1yXkGmk4&latlng=%s,%s&sensor=false", $lat, $long));
    $address_json = json_decode($address_json_str, TRUE);
	print_r($address_json);die;
//    _e($address_json);
//    exit;
    $address = isset($address_json['results'][0]['address_components']) ? $address_json['results'][0]['address_components'] : array();
    $address = array_reverse($address);
//    _e($address);

    for ($i = 0; $i < count($address); $i++)
    {
        if (in_array("locality", $address[$i]['types']))
        {
            $city_name = $address[$i]['long_name'];
            break;
        }
    }
    $location_detail = array("city_name" => $city_name, "address_array" => $address);
    return $location_detail;
}

function get_administrative_area_name_from($google_map_res)
{
    $administrative_area_name = "";
    for ($i = 0; $i < count($google_map_res); $i++)
    {
        if (in_array("political", $google_map_res[$i]['types']) && (in_array("administrative_area_level_1", $google_map_res[$i]['types']) || in_array("administrative_area_level_2", $google_map_res[$i]['types'])))
        {
            $administrative_area_name = $google_map_res[$i]['long_name'];
            break;
        }
    }
    return $administrative_area_name;
}

function user_detail()
{
    $CI = & get_instance();
    $user = $CI->config->item("user_detail");
    return $user;
}

function passenger_id()
{
    $CI = & get_instance();
    $user = $CI->config->item("user_detail");
    return isset($user['pid']) ? $user['pid'] : 0;
}

function driver_id()
{
    $CI = & get_instance();
    $user = $CI->config->item("user_detail");
    return isset($user['did']) ? $user['did'] : 0;
}

function safe_driver_detail($detail)
{
    $CI = &get_instance();
    $CI->load->model("model_driver");
    $default_fields = array_merge(Model_driver::$default_fields, Model_driver::$default_meta);

    $filtered_driver = filter_data_to_api($default_fields, $detail);
    if (isset($filtered_driver['avatar']) && ($filtered_driver['did'] || $filtered_driver['driver_id']))
    {
        $did = isset($filtered_driver['did']) ? $filtered_driver['did'] : $filtered_driver['driver_id'];
        if ($filtered_driver['avatar'] != "")
            $filtered_driver['avatar'] = DRIVER_AVATARURL . AVATAR_DEFAULT_DISPLAY_SIZE . "/crop/center/valign/middle/align/center/avatars/driver/" . $did . "/" . $filtered_driver['avatar'];
        else
            $filtered_driver['avatar'] = DRIVER_AVATARURL . AVATAR_DEFAULT_DISPLAY_SIZE . "/crop/center/valign/middle/align/center/avatars/driver/default.png";
    }
    else if (isset($filtered_driver['avatar']))
        unset($filtered_driver['avatar']);
    if (isset($filtered_driver['auth_token']))
        unset($filtered_driver['auth_token']);
    return $filtered_driver;
}

function safe_passenger_detail($detail)
{
    $CI = &get_instance();
    $CI->load->model("model_passenger");
    $default_fields = array_merge(Model_passenger::$default_fields, Model_passenger::$default_meta);

    $filtered_driver = filter_data_to_api($default_fields, $detail);
    if (isset($filtered_driver['avatar']) && ($filtered_driver['pass_id'] || $filtered_driver['pid'] || $filtered_driver['passenger_id']))
    {
        $did = isset($filtered_driver['pass_id']) ? $filtered_driver['pass_id'] : (isset($filtered_driver['pid']) ? $filtered_driver['pid'] : $filtered_driver['passenger_id']);
        if ($filtered_driver['avatar'] != "")
            $filtered_driver['avatar'] = PASSENGER_AVATARURL . AVATAR_DEFAULT_DISPLAY_SIZE . "/crop/center/valign/middle/align/center/avatars/driver/" . $did . "/" . $filtered_driver['avatar'];
        else
            $filtered_driver['avatar'] = PASSENGER_AVATARURL . AVATAR_DEFAULT_DISPLAY_SIZE . "/crop/center/valign/middle/align/center/avatars/driver/default.png";
    }
    else if (isset($filtered_driver['avatar']))
        unset($filtered_driver['avatar']);
    if (isset($filtered_driver['auth_token']))
        unset($filtered_driver['auth_token']);
    return $filtered_driver;
}

function time_since($original, $today = '')
{
    // array of time period chunks
    $chunks = array(
        array(60 * 60 * 24 * 365, 'year'),
        array(60 * 60 * 24 * 30, 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24, 'day'),
        array(60 * 60, 'hour'),
        array(60, 'min'),
        array(1, 'sec'),
    );

    if ($today == '')
        $today = time(); /* Current unix time  */
    $since = $today - $original;

    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++)
    {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];

        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0)
        {
            break;
        }
    }

    $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";

    if ($i + 1 < $j)
    {
        // now getting the second item
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];

        // add second item if its greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
        {
            $print .= ($count2 == 1) ? ', 1 ' . $name2 : " $count2 {$name2}s";
        }
    }
    return $print;
}

function sort_by($key, $array)
{
    $key_array = array();
    foreach ($array as $key_name => $row)
    {
        $key_array[$key_name] = $row[$key];
    }
    array_multisort($key_array, SORT_DESC, $array);
    return $array;
}

function general_url()
{
	if(ENVIRONMENT=='production')
	    return 'http://fuunly.com/standard/shopping/';
	else
		return 'http://localhost/shopping/';
}
?>
