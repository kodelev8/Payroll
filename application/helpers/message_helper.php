<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This file is used to format messages in a standard way throughout the site
 *
 * @example $this->load->helper('message');
 *
 * Then simple echo show_messages() where required.
 */

function show_messages()
{
    $CI =& get_instance(); //get the global codeigniter instance

    $error = $CI->session->flashdata('error');
    $message = $CI->session->flashdata('message');
    $result = "";
    if ($error != NULL)
    {
        $result.="<div id=\"errormessage\" class=\"alert alert-error\"><p>$error</p></div>";
    }
    if ($message != NULL)
    {
        $result.="<div id=\"message\" class=\"alert alert-success\"><p>$message</p></div>";
    }

    return $result;
}

//this helper outputs the correct shortcut icon link in the HTML.
//To use simply echo the return value.
function fav_icon($favicon = '')
{
   $result = '';
   if ($favicon == '') //if there is no favicon set then we will use the standard Safe4 favicon
      $result = base_url().'images/favicon.ico';
   else
      $result = base_url()."images/$favicon"; //otherwise we will output the one requested.

   return "<link rel=\"SHORTCUT ICON\" href=\"$result\" />";
}

if (!function_exists('encode'))
{
    function encode($v_string, $v_depth = null)
    {
        $m_depth = ($v_depth != null) ? $v_depth : rand(5, 8);

        for ($m_level = 0; $m_level < $m_depth; $m_level++)
        {
            $v_string = base64_encode($v_string);
        }
        $v_string = str_replace(array('+', '/', '='), array('p____p', 's____s', 'e____e'), $v_string);

        return str_replace('=', null, sprintf('%s%d', $v_string, $m_level));
    }
}

if (!function_exists('decode'))
{
    function decode($v_data)
    {
        $m_string = substr($v_data, 0, -1);

        $m_string = str_replace(array('p____p', 's____s', 'e____e'), array('+', '/', '='), $m_string);

        for ($m_level = 0; $m_level < substr($v_data, -1); $m_level++)
        {
            $m_string = base64_decode($m_string);
        }
        return $m_string;
    }
}
?>
