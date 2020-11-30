<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Perfex CRM Powerful Chat
Description: Chat Module for Perfex CRM
Version: 1.3.6
Author: Aleksandar Stojanov
Author URI: https://idevalex.com
Requires at least: 2.3.2
*/

define('PR_CHAT_MODULE_NAME', 'prchat');
define('PR_CHAT_MODULE_UPLOAD_FOLDER', module_dir_path(PR_CHAT_MODULE_NAME, 'uploads'));
define('PR_CHAT_MODULE_GROUPS_UPLOAD_FOLDER', module_dir_path(PR_CHAT_MODULE_NAME, 'uploads/groups'));

/*
 Defined group chat table names
*/
define('chat_prefix', 'mar_');
define('TABLE_STAFF', chat_prefix . 'admin');
define('TABLE_CHATMESSAGES', chat_prefix. 'chatmessages');
define('TABLE_CHATSETTINGS', chat_prefix . 'chatsettings');
define('TABLE_CHATSHAREDFILES', chat_prefix . 'chatsharedfiles');
define('TABLE_CHATGROUPS', chat_prefix . 'chatgroups');
define('TABLE_CHATGROUPMEMBERS', chat_prefix. 'chatgroupmembers');
define('TABLE_CHATGROUPMESSAGES', chat_prefix. 'chatgroupmessages');
define('TABLE_CHATGROUPSHAREDFILES', chat_prefix . 'chatgroupsharedfiles');
define('TABLE_CHATCLIENTMESSAGES', chat_prefix . 'chatclientmessages');

$CI = &get_instance();

/**
 * Register the activation chat
 */
register_activation_hook(PR_CHAT_MODULE_NAME, 'prchat_activation_hook');

/**
 * The activation function
 */
function prchat_activation_hook()
{
	require(__DIR__ . '/install.php');
}

/**
 * Register chat language files
 */
register_language_files(PR_CHAT_MODULE_NAME, ['chat']);

/**
 * Register new menu item in sidebar menu
 */
if (get_option('pusher_chat_enabled') == '1') {
	$CI->app_menu->add_sidebar_menu_item('prchat', [
		'name'     => 'Chat',
		'href'     => admin_url('prchat/Prchat_Controller/chat_full_view'),
		'icon'     => 'fa fa-comments',
		'position' => 6,
	]);
}
/**
 * Load the chat helper
 */
$CI->load->helper(PR_CHAT_MODULE_NAME . '/prchat');
