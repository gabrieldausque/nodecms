<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

$app = Factory::getApplication();
$input = $app->input;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$layout = 'edit';
$tmpl = $input->get('tmpl','','cmd') === 'component' ?
    '&tmpl=component':'';

JHtml::_('script', 'com_teama/helprequest_edit.js', ['version' => 'auto', 'relative' => true]);
$this->document->addStyleSheet('/media/com_teama/css/helprequest.css');

?>
<form action="<?php echo Route::_('index.php?option=com_teama&layout=' . $layout .
    $tmpl . '&id=' . (int)$this->item->id); ?>"
      class="form-validate" method="post">
    <div class="teama-help-request-body">
	    <?php echo HTMLHelper::_('uitab.startTabSet','helpRequestTabs',
		    ['active' => 'details']); ?>
	    <?php echo HTMLHelper::_('uitab.addTab', 'helpRequestTabs', 'publishing',
		    Text::_('COM_TEAMA_HELP_REQUEST_EDIT_GENERAL_OPTIONS')); ?>
        <?php
		    echo $this->getForm()->renderFieldSet("general");
        ?>
	    <?php echo HTMLHelper::_('uitab.endTab') ?>
	    <?php echo HTMLHelper::_('uitab.addTab', 'helpRequestTabs', 'publishing',
		    Text::_('COM_TEAMA_HELP_REQUEST_EDIT_OBJECTIVES_OPTIONS')); ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#helprequest-add-objective-modal">
		    <?php echo Text::_('COM_TEAMA_HELPREQUEST_ADD_OBJECTIVE') ?>
        </button>
        <?php echo $this->getForm()->renderField('objectives') ?>
	    <?php echo HTMLHelper::_('uitab.endTab') ?>
	    <?php echo HTMLHelper::_('uitab.endTabSet') ?>
    </div>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>

<div class="modal fade" id="helprequest-add-objective-modal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"><?php echo Text::_('COM_TEAMA_HELPREQUEST_ADD_OBJECTIVE') ?></h2>
            </div>
            <div class="modal-body">
                <form id="new-objective-form">
	                <?php
	                echo $this->get("ObjectiveForm")->renderFieldSet("general");
	                ?>
	                <?php echo HTMLHelper::_('form.token'); ?>
                </form>
            </div>
            <div class="modal-footer">
                <button id="add-objective-close-btn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="add-objective-btn" type="button" class="btn btn-primary" onclick="addObjectiveOnClick()"><?php echo Text::_('COM_TEAMA_ADD') ?></button>
            </div>
        </div>
    </div>
</div>
