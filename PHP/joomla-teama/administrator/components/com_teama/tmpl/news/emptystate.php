<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$displayData = [
  'textPrefix' => 'COM_TEAMA',
  'formUrl' => 'index.php?option=com_teama',
  'helpUrl' => 'https://www.google.fr',
  'icon' => 'icon-copy'
];

?>
<form action="<?php echo Route::_('index.php?option=com_teama&task=news.display'); ?>"
       method="post"
       name="adminForm"
       id="adminForm"
>
  <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>
  <?php echo LayoutHelper::render('joomla.content.emptystate', $displayData); ?>
</form>
