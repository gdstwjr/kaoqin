<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function app_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->slash_item('base_url') . APPPATH;
}

/* End of file MY_url_helper.php */