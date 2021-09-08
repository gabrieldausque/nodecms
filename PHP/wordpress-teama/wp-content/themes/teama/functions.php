<?php

require_once('custom-login.php');

function enqueue_teama_style(){
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap/bootstrap.min.css' );
    wp_enqueue_style('teama-common-style', get_stylesheet_uri());
    wp_enqueue_style('teama-style', get_template_directory_uri().'/assets/css/teama-login.css');
}

function enqueue_teama_scripts(){
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap/bootstrap.bundle.js');
	wp_enqueue_script('teama-script', get_template_directory_uri().'/assets/js/teama.js');
}

function left_panel() {
	set_query_var('panel_id','teama-left-panel');
	get_template_part('panel');
}

function right_panel() {
	set_query_var('panel_id','teama-right-panel');
	get_template_part('panel');
}

function add_nav_bar() {
	get_template_part('templates/navbar');
}

add_action('wp_enqueue_scripts','enqueue_teama_style');
add_action('wp_enqueue_scripts','enqueue_teama_scripts');
add_filter('show_admin_bar', function() { return false; });

add_theme_support( 'custom-logo' );

/**
 * custom login page
 */

add_action('login_header', 'add_navbar_for_login');
