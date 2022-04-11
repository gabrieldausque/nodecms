<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\Router\Route;

\defined('_JEXEC') or die;

$app = Factory::getApplication();
$input = $app->input;
$document = $app->getDocument();

$wa = $this->document->getWebAssetManager();
$layout = 'edit';
$tmpl = $input->get('tmpl','','cmd') === 'component' ?
	'&tmpl=component':'';

//TODO : add stylesheet or js

?>
<div class="teama-section-title text-white">
    <div class="teama-section-title-text">
		<?php $label = $this->item->id == 0?
			Text::_('COM_TEAMA_HELP_REQUEST_CREATING'):
			Text::_('COM_TEAMA_EDITING') . ' : ' . $this->item->title;
		echo $label;
		?>
    </div>
    <div class="teama-section-title-decoration sm"></div>
    <div class="teama-section-title-decoration"></div>
</div>
<form action="<?php echo Route::_('index.php?option=com_teama&layout=' . $layout .
	$tmpl . '&id=' . (int)$this->item->id); ?>"
      class="form-validate teama-helprequest-forms"
      method="post">
	<?php echo $this->getForm()->renderField('request_service'); ?>
	<?php echo $this->getForm()->renderField('requester'); ?>
    <div>
		<?php echo HTMLHelper::_('uitab.startTabSet','myTab',
            ['active' => 'details']); ?>
		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing',
            Text::_('COM_TEAMA_HELP_REQUEST_EDIT_GENERAL_OPTIONS')); ?>
		<?php echo $this->getForm()->renderField('content'); ?>
		<?php echo $this->getForm()->renderField('request_datetime'); ?>
		<?php echo $this->getForm()->renderField('address'); ?>
		<?php echo $this->getForm()->renderField('difficulties'); ?>
        <!-- TODO : Request type -->
		<?php echo HTMLHelper::_('uitab.endTab') ?>
		<?php echo HTMLHelper::_('uitab.endTabSet') ?>
    </div>
    <input type="hidden" name="task" value="helprequest.save">
	<?php echo HTMLHelper::_('form.token'); ?>
    <div class="form-footer">
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-save"></i><?php echo ' ' . Text::_('COM_TEAMA_REGISTER_LABEL') ?>
        </button>
    </div>
</form>
