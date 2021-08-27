<?php

function add_navbar_for_login() {
	get_template_part('templates/navbar');
}

function add_login_script() {
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap/bootstrap.bundle.min.js');
	wp_enqueue_script('teama-login', get_template_directory_uri().'/assets/js/teama-login.js');
}

function add_login_style() {
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap/bootstrap.min.css');
	wp_enqueue_style('teama-common-login-style', get_stylesheet_uri());
	wp_enqueue_style('teama-login', get_template_directory_uri().'/assets/css/teama-login.css');
}

function add_custom_login_styles(){
	get_template_part('templates/login/custom-login-styles');
}

function add_modal() {
	get_template_part('templates/login/login-modal');
}

add_action('login_enqueue_scripts', 'add_login_style');
add_action('login_enqueue_scripts', 'add_login_script');
add_action('login_head', 'add_custom_login_styles');
add_action('login_footer', 'add_modal');