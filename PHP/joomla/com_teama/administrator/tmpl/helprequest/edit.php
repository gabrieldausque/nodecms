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
    <div class="teama-help-request-header">
        <?php foreach ($this->header_fields as $header_field) {
            echo $this->getForm()->renderField($header_field);
        } ?>
    </div>
    <div class="teama-help-request-body">
        <?php foreach($this->body_fields as $body_field) {
            if($body_field->isFieldSet)
                echo $this->getForm()->renderFieldSet($body_field->name);
            else
                echo $this->getForm()->renderField($body_field->name);
        }?>
        <div class="teama-help-request-objectives">

        </div>
        <div class="teama-help-request-weapons">

        </div>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>