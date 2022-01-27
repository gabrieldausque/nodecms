<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

\defined('_JEXEC') or die;

include __DIR__ . '/../headers/toolbar.php';

$app = Factory::getApplication();
$document = $app->getDocument();

//TODO : set the api key in a configuration from Joomla
JHtml::_('script', 'com_teama/offshoots.js', ['version' => 'auto', 'relative' => true]);
$document->addStyleSheet('/media/com_teama/css/offshoots.css');

?>
<div class="teama-section">
    <div id="map"></div>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGojXnPxXiZKXhpP_fuCmBBo9zRDbkDkE&callback&callback=initMap&v=weekly"
            async
    ></script>
</div>
