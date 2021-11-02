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


$app = Factory::getApplication();
$document = $app->getDocument();

JHtml::_('script', 'com_teama/default.js', ['version' => 'auto', 'relative' => true]);
$document->addStyleSheet('/media/com_teama/css/default.css');

$classByActions = [
    'new' => 'btn-outline-success',
    'edit' => 'btn-success',
    'delete' => 'btn-danger',
    'add' => 'btn-success'
]

?>

<?php if(property_exists($this, 'actions') &&
         is_array($this->actions) &&
         count($this->actions) > 0
) { ?>
<div id="teama-component-toolbar" class="teama-toolbar">
    <?php foreach($this->actions as $action) { ?>
        <button class="btn <?php echo $classByActions[$action->name] ?>" type="button" data-link="<?php echo $action->link ?>">
          <?php echo Text::_('COM_TEAMA_ACTION_' . strtoupper($action->name) . '_LABEL') ?>
        </button>
    <?php }?>
</div>
<?php } ?>
