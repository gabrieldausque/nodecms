<?php

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$webAssetManager = $this->getWebAssetManager();
$templatePath = 'templates/' . $this->template;

$webAssetManager->registerAndUseStyle('teama-bootstrap-styles', $templatePath . '/css/bootstrap/bootstrap.css');
$webAssetManager->registerAndUseStyle('teama-main-styles', $templatePath . '/css/template.css');
$webAssetManager->registerAndUseStyle('teama-fonts', $templatePath . '/css/fonts.css');
$webAssetManager->registerAndUseScript('teama-bootstrap', $templatePath . '/js/bootstrap/bootstrap.bundle.js');
$webAssetManager->registerAndUseScript('teama-main', $templatePath . '/js/teama.js');

foreach ($webAssetManager->getAssets('style') as $style)
{
	$this->getPreloadManager()->prefetch($style->getUri(), ['as' => 'style']);
}

foreach ($webAssetManager->getAssets('script') as $script)
{
	$this->getPreloadManager()->prefetch( $script->getUri(), [ 'as' => 'script' ] );
}

$user = $app->getIdentity();
$isAuthenticate = !$user->guest;

$logoUrl = '';
$siteName = htmlspecialchars($this->params->get('siteTitle'), ENT_QUOTES, 'UTF-8');

if ($this->params->get('logoFile'))
{
    $logoUrl = Uri::root(true) . '/' .  htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES);
} else {
    $logoUrl = $templatePath . '/images/a-team_logo.png';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<jdoc:include type="head" />
</head>
<body class="<?php
    $bodyClass = $isAuthenticate ? 'teama-connected' : 'teama-notconnected';
    echo $bodyClass;
?>">
<header class="p-3 teama-navbar text-white">
    <nav class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <?php if (!$isAuthenticate) { ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
            <?php } ?>
        </div>
    </nav>
</header>
<?php if ($isAuthenticate)
{   
    ?>
    <jdoc:include type="modules" name="top" />
    <jdoc:include type="component" />
    <jdoc:include type="modules" name="bottom" />
<?php } else  {  ?>
        <div class="teama-viewport container-fluid d-flex flex-column align-self-center justify-content-evenly">
            <h4 class="teama-tagline-landing-page"><?php echo $this->params->get('siteDescription') ?></h4>
            <div class="teama-logo-landing-page"
                 style="background-image: url('<?php echo $logoUrl ?>')" >
            </div>
            <h1 class="teama-title-landing-page"><?php echo $siteName ?></h1>
        </div>
    <div class="modal fade" id="login-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header bg-darklight">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<?php
                        $loginModule = ModuleHelper::getModule('mod_login');
                        echo ModuleHelper::renderModule($loginModule);
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="teama-login-button" type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</body>
</html>