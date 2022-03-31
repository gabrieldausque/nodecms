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
$config = $this->get('State')->get('params');
$offshoots = $this->items;
JHtml::_('script', 'com_teama/offshoots.js', ['version' => 'auto', 'relative' => true]);
$document->addStyleSheet('/media/com_teama/css/offshoots.css');
$offshootsOptions = $document->getScriptOptions('offshoots');

$offshootsOptions['offshoots'] = $offshoots;
$document->addScriptOptions('offshoots', $offshootsOptions);
$user = $app->getIdentity();
$isAuthenticate = !$user->guest;
if($isAuthenticate) {
?>
<div class="teama-section">
    <script type="application/javascript">
        window.addEventListener('GMAP_INITIALIZED', async () => {
            console.log('gmap has been initialized');
        })
    </script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config->get('google_map_api_key') ?>&callback&callback=initMap&v=weekly"
            async
    ></script>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <form class="d-flex" onkeydown="return event.key != 'Enter';">
                <input id="location-for-distance" class="form-control me-2" type="search"
                       placeholder="<?php echo Text::_('COM_TEAMA_INTERVENTION_LOCATION');  ?>">
                <button id="search-nearest-distance" class="btn btn-outline-success" type="button" disabled><?php echo Text::_('COM_TEAMA_INTERVENTION_LOCATION_SEARCH_NEAREST');  ?></button>
            </form>
        </div>
    </nav>
    <div class="map-viewport">
        <div id="map-metropole"></div>
        <div class="offshoots-list">
            <div id="offshoots" class="list-group offshoots" >
            <?php foreach ($offshoots as $offshoot) {
                ?><div id="offshoot-summary-<?php echo $offshoot->id ?>" class="list-group-item list-group-item-action offshoot-summary" data-offshoot-id="<?php echo $offshoot->id ?>">
                <h5><?php echo $offshoot->name ?></h5>
                <p><?php echo $offshoot->address ?></p>
                </div><?php
            }?>
            </div>
            <?php foreach($offshoots as $offshoot) { ?>
            <div id="offshoot-details-<?php echo $offshoot->id ?>"
                 class="card offshoot-details">
                <div class="card-header">
                    Details
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $offshoot->name ?></h5>
                    <p class="card-text"><?php echo $offshoot->address ?></p>
                    <p class="card-text"><?php echo $offshoot->phone_number ?></p>
                    <a href="mailto:<?php echo $offshoot->mail ?>"><?php echo $offshoot->mail ?></a>
                </div>
            </div>
            <?php } ?>
            <div id="steps"></div>
        </div>
    </div>
</div>
<?php
}