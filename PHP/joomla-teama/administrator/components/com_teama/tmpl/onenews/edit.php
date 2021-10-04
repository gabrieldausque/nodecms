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
    <?php echo $this->getForm()->renderFieldSet('header-media'); ?>
    <?php echo $this->getForm()->renderField('summary'); ?>
    <?php echo $this->getForm()->renderField('body'); ?>

  <input type="hidden" name="task" value="">
  <?php echo HTMLHelper::_('form.token'); ?>
</form>

</form>
