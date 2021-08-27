<?php

$logo = get_theme_mod('custom_logo', false);
$hasLogo = false;
$src = '';
if(!empty($logo)){
	$hasLogo = true;
	$src = wp_get_attachment_image_src($logo)[0];
}

?>
<style>
	<?php if($hasLogo): ?>
#login > h1 > a {
	background-image: url(<?php _e($src) ?>)
}
<?php endif ?>
</style>