<?php

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$webAssetManager = $this->getWebAssetManager();
$templatePath = 'templates/' . $this->template;
$webAssetManager->registerAndUseStyle('fontawesome', 'media/system/css/joomla-fontawesome.min.css');
$webAssetManager->registerAndUseStyle('teama-bootstrap-styles', $templatePath . '/css/bootstrap/bootstrap.css');
$webAssetManager->registerAndUseStyle('teama-main-styles', $templatePath . '/css/template.css');
$webAssetManager->registerAndUseStyle('teama-fonts', $templatePath . '/css/fonts.css');
$webAssetManager->registerAndUseStyle('teama-fontawesome', $templatePath . '/css/fontawesome/css/all.css');
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
<div class="teama-viewport container-fluid d-flex flex-row align-items-start justify-content-start">
    <div class="teama-content-panel">
        <?php if($isAuthenticate) { ?>
        <div class="teama-left-panel d-flex flex-column justify-content-start align-items-center">
            <div class="teama-brand-container d-flex flex-row justify-content-start align-items-center bg-dark">
                <div id="teama-brand-logo" style="background-image: url('<?php echo $logoUrl ?>');"></div>
                <h5 id="teama-brand-title"><?php echo $siteName ?></h5>
            </div>
	        <?php if ($isAuthenticate)
	        { ?>
            <jdoc:include type="modules" name="left"/>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="teama-middle-panel">
            <header class="teama-navbar text-white">
                <nav id="teama-header-toolbar" class=" d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			        <?php if (!$isAuthenticate) { ?>
                        <button id="teama-login-modal-button" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
			        <?php } else { ?>
                        <jdoc:include type="modules" name="header"/>
			        <?php } ?>
                </nav>
            </header>
          <?php if($isAuthenticate) { ?>
            <div class="container-fluid teama-user-content-panel">
                <div class="row">
                    <div class="col">
                        <jdoc:include type="modules" name="breadcrumb"/>
                        <jdoc:include type="modules" name="top" />
                        <jdoc:include type="message" />
                        <jdoc:include type="component"/>
                        <footer class="teama-content-footer">
                            <jdoc:include type="modules" name="bottom" />
                        </footer>
                    </div>
                    <div class="teama-widget-panel">
                        <jdoc:include type="modules" name="right"/>
                    </div>
                </div>
            </div>
            <div id="teama-loading-screen">
                <div class="spinner-border teama-loading-spinner text-danger"></div>
                <div class="teama-loading-label"><?php echo Text::_('TPL_TEAMA_LOADING') ?></div>
            </div>
        </div>
    </div>
      <?php } else  {  ?>
          <div class="teama-landingpage-main d-flex flex-column align-items-center justify-content-around">
              <h4 class="teama-tagline-landing-page"><?php echo $this->params->get('siteDescription') ?></h4>
              <div class="teama-logo-landing-page"
                   style="background-image: url('<?php echo $logoUrl ?>')" >
                  <div id="teama-top-border"></div>
                  <div id="teama-right-border"></div>
                  <div id="teama-bottom-border"></div>
                  <div id="teama-left-border"></div>
              </div>
              <h1 class="teama-title-landing-page"><?php echo $siteName ?></h1>
          </div>
          <div class="modal fade" id="login-modal" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered" >
                  <div class="modal-content">
                      <div class="modal-header bg-darklight">
                          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                          <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close">
                          </button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $loginModule = ModuleHelper::getModule('mod_login');
                        echo ModuleHelper::renderModule($loginModule);
                        ?>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button id="teama-login-button" type="button" class="btn btn-danger">Login</button>
                      </div>
                  </div>
              </div>
          </div>
      <?php } ?>
    </div>
</div>
</body>
</html>