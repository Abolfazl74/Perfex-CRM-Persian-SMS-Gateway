<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: ماژول پیامک StuXan
Description: این ماژول پیامک یک افزونه جهت استفاده در سامانه جامع پروفکس طراحی شده است و فقط در نسخه نال شده StuXan قابل استفاده است.
Author: StuXan
Version: 2.1.1
Requires at least: 2.9.*
Author URI: https://stuxan.ir
*/

define('STUXAN_PARSGREEN_MODULE_NAME', 'stuxan_parsgreen');

hooks()->add_action('admin_init', 'stuxan_parsgreen_hook_admin_init');
hooks()->add_filter('module_'.STUXAN_PARSGREEN_MODULE_NAME.'_action_links', 'module_stuxan_parsgreen_action_links');
hooks()->add_action('settings_tab_footer','stuxan_parsgreen_hook_settings_tab_footer');#pour perfex version < V2.4 
hooks()->add_action('settings_group_end','stuxan_parsgreen_hook_settings_tab_footer');#pour perfex version > V2.8.4

/**
* OVH sms hub has been used in this module. -StuXan
*/

function module_stuxan_parsgreen__init_menu_items(){
}
	
function module_stuxan_parsgreen_action_links($actions)
{
	//if((get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated') == 'true') && (get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code')!='')){
		$actions[] = '<a href="' . admin_url('settings?group=sms') . '">' . _l('settings') . '</a>';
		//$actions[] = '<a href="' . admin_url('settings?group=stuxan_parsgreen_settings') . '">' . _l('stuxan_parsgreen_settings_license') . '</a>';
		
	//}
	//else
	//	$actions[] = '<a href="' . admin_url('settings?group=stuxan_parsgreen_settings') . '">' . _l('stuxan_parsgreen_settings_validate') . '</a>';
		
	return $actions;
}

function stuxan_parsgreen_hook_settings_tab_footer($tab)
{
	if($tab['slug']=='stuxan_parsgreen_settings' && (get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated') != 'true')){
		echo '<script src="'.module_dir_url('stuxan_parsgreenhub','assets/js/stuxan_parsgreen_settings_footer.js').'"></script>';
	}
}



register_activation_hook(STUXAN_PARSGREEN_MODULE_NAME, 'stuxan_parsgreen_activation_hook');

function stuxan_parsgreen_activation_hook()
{
	$CI = &get_instance();
	require_once(__DIR__ . '/install.php');
}


register_language_files(STUXAN_PARSGREEN_MODULE_NAME, [STUXAN_PARSGREEN_MODULE_NAME]);


function stuxan_parsgreen_hook_admin_init()
{
	$CI = &get_instance();
	
	if (is_admin() || has_permission('settings', '', 'view')) {
		$CI->app_tabs->add_settings_tab('stuxan_parsgreen_settings', [
			'name'     => _l('stuxan_parsgreen_settings'),
			'view'     => 'stuxan_parsgreenhub/stuxan_parsgreen_settings',
			'position' => 60,
		]);
	}
}
//if((get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activated') == 'true') && (get_option(STUXAN_PARSGREEN_MODULE_NAME.'_activation_code')!=''))
	
$CI  =&get_instance();
$CI->load->library(STUXAN_PARSGREEN_MODULE_NAME . '/sms_parsgreen');