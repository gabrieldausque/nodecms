<?php

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use \Joomla\CMS\HTML\HTMLHelper;

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
<body>
<?php if ($isAuthenticate)
{   
    ?>
    <jdoc:include type="modules" name="top" />
    <jdoc:include type="component" />
    <jdoc:include type="modules" name="bottom" />
<?php } else  {  ?>
    <h6><?php echo $this->params->get('siteDescription') ?></h6>
    <img src="<?php echo $logoUrl ?>">
    <h1><?php echo $siteName ?></h1>
<?php } ?>
</body>
</html>