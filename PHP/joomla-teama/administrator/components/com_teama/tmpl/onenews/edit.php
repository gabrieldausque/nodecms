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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

$app = \Joomla\CMS\Factory::getApplication();
$input = $app->input;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
   ->useScript('form.validate');

$layout = 'edit';
$tmpl = $input->get('tmpl','','cmd') === 'component' ?
  '&tmpl=component':'';
?>
<form action="<?php echo Route::_('index.php?option=com_teama&layout=' . $layout .
                                  $tmpl . '&id=' . (int)$this->theNews->id); ?>" class="form-validate" method="post">
  <?php echo $this->getForm()->renderField('title'); ?>
  <?php echo $this->getForm()->renderField('summary'); ?>
    <div>
      <?php echo HTMLHelper::_('uitab.startTabSet','myTab', ['active' => 'details']); ?>
      <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('COM_TEAMA_NEWS_EDIT_GENERAL_OPTIONS')); ?>
      <?php echo $this->getForm()->renderFieldSet('header-media'); ?>
      <?php echo $this->getForm()->renderField('body'); ?>
      <?php echo HTMLHelper::_('uitab.endTab') ?>
      <?php echo HTMLHelper::_('uitab.endTabSet') ?>
    </div>
    <input type="hidden" name="task" value="">
  <?php echo HTMLHelper::_('form.token'); ?>
</form>