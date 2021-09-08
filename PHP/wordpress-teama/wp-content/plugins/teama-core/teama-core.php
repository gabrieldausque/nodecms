<?php

/*
Plugin Name: TEAM A Core plugin
Description: The Team A core plugin
Version: 0.0.1
Author: Gabriel DAUSQUE-JOUAN
Author URI: http://theloneblacksheep.fr/

Text Domain: teama
Domain Path: /languages

License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

require_once(plugin_dir_path(__FILE__).'/controllers/LoginController.php');

function register_login_rest_api() {
	$loginController = new LoginController();
	$loginController->register_routes();
}
add_action('rest_api_init', 'register_login_rest_api');
