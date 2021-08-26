<?php
require_once('functions.php');
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="teama-header">
    <nav class="navbar navbar-light teama-navbar">
        <div class="container-fluid">
            <div id="teama-brand-logo" class="brand-logo" style="background-image: url('<?php
            $logo = get_theme_mod('custom_logo');
            $src = wp_get_attachment_image_src($logo);
            _e($src[0]); ?>')" ></div>
            <a class="navbar-brand teama-title" href="#"><?php bloginfo('name'); ?></a>
        </div>
    </nav>
</header>

<div class="teama-viewport">
<?php left_panel(); ?>


