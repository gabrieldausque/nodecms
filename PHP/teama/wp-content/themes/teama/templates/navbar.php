<?php

?>

<nav class="navbar navbar-light teama-navbar">
	<div class="container-fluid">
		<div id="teama-brand-logo" class="brand-logo" style="background-image: url('<?php
		$logo = get_theme_mod('custom_logo');
		$src = wp_get_attachment_image_src($logo);
		_e($src[0]); ?>')" ></div>
		<a class="navbar-brand teama-title" href="#"><?php bloginfo('name'); ?></a>

        <?php if(!is_user_logged_in()): ?>
            <btn class="btn btn-danger" type="button" id="connect-button" data-bs-toggle="modal" data-bs-target="#login-modal"><?php _e('Login')?></btn>
        <?php endif; ?>

	</div>
</nav>
