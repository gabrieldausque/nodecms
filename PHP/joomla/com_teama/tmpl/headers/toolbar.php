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
    'edit' => 'btn-success',
    'delete' => 'btn-danger',
    'create' => 'btn-success'
]

?>

<?php if(property_exists($this, 'actions') &&
         is_array($this->actions) &&
         count($this->actions) > 0
) { ?>
<div class="modal fade" id="teama-toolbar-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header bg-darklight">
                <h5 class="modal-title" id="teama-toolbar-modal-confirmation">Confirmation</h5>
                <button type="button"
                        class="btn-close btn-danger"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <div id="teama-toolbar-modal-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button id="teama-toolbar-cancel" type="button" class="btn btn-secondary"><?php echo Text::_('COM_TEAMA_CANCEL_LABEL') ?></button>
                <button id="teama-toolbar-ok" type="button" class="btn btn-danger">Ok</button>
            </div>
        </div>
    </div>
</div>
<div id="teama-component-toolbar" class="teama-toolbar">
    <?php foreach($this->actions as $action) { ?>
        <button class="btn <?php echo $classByActions[$action->name] ?>" type="button" data-link="<?php echo $action->link ?>"
                data-use-confirmation="<?php echo $action->useConfirmation ?>"
                data-confirmation-message="<?php echo htmlspecialchars($action->confirmationMessage) ?>"
        >
          <?php echo Text::_('COM_TEAMA_ACTION_' . strtoupper($action->name) . '_LABEL') ?>
        </button>
    <?php }?>
</div>

<?php } ?>
