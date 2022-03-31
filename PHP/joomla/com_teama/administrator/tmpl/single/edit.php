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
?>
<form action="<?php echo Route::_('index.php?option=com_teama&layout=' . $layout .
                                  $tmpl . '&id=' . (int)$this->item->id); ?>"
      class="form-validate" method="post">
    <?php foreach ($this->header_fields as $header_field) {
	    echo $this->getForm()->renderField($header_field);
    } ?>
    <?php //TODO : Manage multiple tabs in forms ?>
    <div>
      <?php echo HTMLHelper::_('uitab.startTabSet','myTab', ['active' => 'details']); ?>
      <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('COM_TEAMA_EDIT_GENERAL_OPTIONS')); ?>
      <?php foreach($this->body_fields as $body_field) {
          if($body_field->isFieldSet)
              echo $this->getForm()->renderFieldSet($body_field->name);
          else
              echo $this->getForm()->renderField($body_field->name);
      }?>
      <?php echo HTMLHelper::_('uitab.endTab') ?>
      <?php echo HTMLHelper::_('uitab.endTabSet') ?>
    </div>
    <input type="hidden" name="task" value="">
  <?php echo HTMLHelper::_('form.token'); ?>
</form>