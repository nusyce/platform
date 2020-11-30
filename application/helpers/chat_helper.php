<?php
/*
Module Name: Perfex CRM Chat
Description: Chat Module for Perfex CRM
Author: Aleksandar Stojanov
Author URI: https://idevalex.com
*/

defined('BASEPATH') or exit('No direct script access allowed');
define('CHAT_CURRENT_URI', strtolower($_SERVER['REQUEST_URI']));

function isClientsEnabled()
{
    return get_option('chat_client_enabled');
}
function pr_get_chat_color($id, $name = '')
{
	$CI = &get_instance();

	if ($CI->db->field_exists('value', db_prefix() . 'chatsettings')) {
		return pr_get_chat_option($id, $name);
	} else {
		$CI->db->select('chat_color');
		$CI->db->where('user_id', $id);
	}
	$result = $CI->db->get(db_prefix() . 'chatsettings')->row();

	if (!$result) {
		return '';
	}

	return $result->chat_color;
}
function pr_get_chat_option($id, $name)
{
	$CI = &get_instance();
	$CI->db->select('value');
	$CI->db->where('name', $name);
	$CI->db->where('user_id', $id);

	$result = $CI->db->get(db_prefix() . 'chatsettings')->row();

	if (!$result) {
		return '';
	}

	return $result->value;
}
function pr_chat_convertLinkImageToString($string)

{

	$regexImg = '/(http|https)\:\/\/(([a-zA-Z]{1}[a-zA-Z]{1})|([a-zA-Z0-9][a-zA-Z0-9-_]{1,61}[a-zA-Z0-9]))+.(\/\S*)?(gif|jpg|jpeg|tiff|png|swf|PNG|JPG|JPEG)(\/\S*)?/m';
	if (preg_match_all($regexImg, $string)) {
		$string = preg_replace($regexImg, '<a href="' . htmlspecialchars('$0') . '" data-lity><img class="prchat_convertedImage" src="' . htmlspecialchars('$0') . '"/></a>', $string);
	}

	return $string;
}
function check_for_links_lity($ret)
{
	return clickable($ret);
}
function make_url_clickable_cb($matches)
{
	$ret = '';
	$url = $matches[2];
	if (empty($url)) {
		return $matches[0];
	}
	// removed trailing [.,;:] from URL
	if (in_array(substr($url, -1), [
			'.',
			',',
			';',
			':',
		]) === true) {
		$ret = substr($url, -1);
		$url = substr($url, 0, strlen($url) - 1);
	}

	$hrefDest = str_replace('https://', '//', $url);
	$hrefDest = str_replace('http://', '//', $url);

	return $matches[1] . "<a href=\"$hrefDest\" rel=\"nofollow\" data-lity target='_blank'>$url</a>" . $ret;
}

/**
 * Callback for clickable
 */
function make_web_ftp_clickable_cb($matches)
{
	$ret  = '';
	$dest = $matches[2];
	$dest = 'http://' . $dest;
	if (empty($dest)) {
		return $matches[0];
	}
	// removed trailing [,;:] from URL
	if (in_array(substr($dest, -1), [
			'.',
			',',
			';',
			':',
		]) === true) {
		$ret  = substr($dest, -1);
		$dest = substr($dest, 0, strlen($dest) - 1);
	}

	$hrefDest = str_replace('https://', '//', $dest);
	$hrefDest = str_replace('http://', '//', $dest);

	return $matches[1] . "<a href=\"$hrefDest\" rel=\"nofollow\" data-lity target='_blank'>$dest</a>" . $ret;
}

/**
 * Callback for clickable
 */
function make_email_clickable_cb($matches)
{
	$email = $matches[2] . '@' . $matches[3];

	return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}
function clickable($ret)
{
	$ret = ' ' . $ret;
	// in testing, using arrays here was found to be faster
	$ret = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'make_url_clickable_cb', $ret);
	$ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'make_web_ftp_clickable_cb', $ret);
	$ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', 'make_email_clickable_cb', $ret);
	// this one is not in an array because we need it to run last, for cleanup of accidental links within links
	$ret = preg_replace('#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i', '$1$3</a>', $ret);
	$ret = trim($ret);

	return $ret;
}
