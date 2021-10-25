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

$webAssetManager->registerAndUseStyle('fontawesome', 'media/system/css/joomla-fontawesome.min.css');
$webAssetManager->registerAndUseStyle('teama-bootstrap-styles', $templatePath . '/css/bootstrap/bootstrap.css');
$webAssetManager->registerAndUseStyle('teama-main-styles', $templatePath . '/css/template.css');
$webAssetManager->registerAndUseStyle('teama-fonts', $templatePath . '/css/fonts.css');
$webAssetManager->registerAndUseStyle('teama-fontawesome', $templatePath . '/css/fontawesome/css/all.css');
$webAssetManager->registerAndUseScript('teama-bootstrap', $templatePath . '/js/bootstrap/bootstrap.bundle.js');
$webAssetManager->registerAndUseScript('teama-main', $templatePath . '/js/teama.js');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<jdoc:include type="metas" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="teama-component-body">
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>

