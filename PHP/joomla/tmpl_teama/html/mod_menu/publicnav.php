<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();
$templatePath = 'templates/' . $app->getTemplate();
$wa->registerAndUseScript('teama-publicnav', $templatePath . '/js/publicnav.js');

?>
<div class="teama-publicnav-zone">
<?php
foreach ($list as $i => &$item)
{
	$title = $item->title;
	$link = $item->link;
?>
	<button class="btn btn-danger" type="button" data-link="<?php echo $link ?>" onclick="publicNavOpenLink(this)"><?php echo $title ?></button>
<?php }
?>
</div>
