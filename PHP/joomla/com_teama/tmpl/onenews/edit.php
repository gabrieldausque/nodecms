<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
\defined('_JEXEC') or die;

include __DIR__ . '/../headers/toolbar.php';

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

$app = \Joomla\CMS\Factory::getApplication();
$input = $app->input;

$document = $app->getDocument();
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
   ->useScript('form.validate');
JHtml::_('script', 'com_teama/onenews_edit.js', ['version' => 'auto', 'relative' => true]);
$layout = 'edit';
$tmpl = $input->get('tmpl','','cmd') === 'component' ?
  '&tmpl=component':'';

$document->addStyleSheet('/media/com_teama/css/onenews.css');

?>
<div class="teama-section-title text-white">
    <div class="teama-section-title-text">
      <?php $label = $this->item->id == 0?
         Text::_('COM_TEAMA_NEWS_CREATING'):
         Text::_('COM_TEAMA_EDITING') . ' : ' . $this->item->title;
         echo $label;
      ?>
    </div>
    <div class="teama-section-title-decoration sm"></div>
    <div class="teama-section-title-decoration"></div>
</div>
<form action="<?php echo Route::_('index.php?option=com_teama&layout=' . $layout .
                                  $tmpl . '&id=' . (int)$this->item->id); ?>"
      class="form-validate teama-news-forms"
      method="post">
  <?php echo $this->getForm()->renderField('title'); ?>
  <?php echo $this->getForm()->renderField('summary'); ?>
    <div>
      <?php echo HTMLHelper::_('uitab.startTabSet','myTab', ['active' => 'details']); ?>
      <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('COM_TEAMA_NEWS_EDIT_GENERAL_OPTIONS')); ?>
      <?php echo $this->getForm()->renderFieldSet('header-media'); ?>
      <?php echo $this->getForm()->renderField('body'); ?>
      <?php echo $this->getForm()->renderField('tags'); ?>
      <?php echo HTMLHelper::_('uitab.endTab') ?>
      <?php echo HTMLHelper::_('uitab.endTabSet') ?>
    </div>
    <input type="hidden" name="task" value="onenews.save">
    <?php echo HTMLHelper::_('form.token'); ?>
    <div class="form-footer">
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-save"></i><?php echo ' ' . Text::_('COM_TEAMA_REGISTER_LABEL') ?>
        </button>
    </div>
</form>

