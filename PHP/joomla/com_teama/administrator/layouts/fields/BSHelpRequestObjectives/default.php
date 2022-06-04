<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

// use $displayData->value : to get data.
use Joomla\CMS\Language\Text;

$linkedIds = [];
if(isset($displayData) && is_array($displayData['value'])){
	foreach($displayData['value'] as $linkedObjective){
		array_push($linkedIds, $linkedObjective->id);
	}
}
?>
<input name="jform[objectives]" id="jform_objectives"
       type="hidden" class="form-control teama-helprequest-field required valid form-control-success"
       value="<?php echo json_encode($linkedIds) ?>"
/>
<div class="teama-help-request-objectives-displayed">
	<?php if(isset($displayData) && is_array($displayData['value'])){
		foreach($displayData['value'] as $linkedObjective){
			?>
			<div class="card w-25" id="<?php echo 'linked-objective-' . $linkedObjective->id ?>" >
				<?php if(!empty($linkedObjective->photo)) { ?>
                    <img src="/<?php echo $linkedObjective->photo; ?>>" class="card-img-top objective-photo">
                <?php } ?>
				<div class="card-body">
					<h2 class="card-title"><?php echo $linkedObjective->lastname . ' ' . $linkedObjective->firstname ?></h2>
					<p class="card-text"><b><?php echo Text::_('COM_TEAMA_AGE')?> : </b><span><?php echo $linkedObjective->age ?></span></p>
					<p class="card-text"><b><?php echo Text::_('COM_TEAMA_SEX')?> : </b><span><?php echo $linkedObjective->sex ?></span></p>
					<p class="card-text"><b><?php echo Text::_('COM_TEAMA_DANGEROUSNESS')?> : </b><span><?php echo $linkedObjective->dangerousness ?></span></p>
					<p class="card-text"><b><?php echo Text::_('COM_TEAMA_COMMENTS')?> : </b><br><span><?php echo $linkedObjective->comment ?></span></p>
				</div>
			</div>
			<?php
		}
	} ?>
</div>

<div class="card w-25 card-template" id="card-template" >
	<img src="" class="card-img-top objective-photo">
	<div class="card-body">
		<h2 class="card-title"></h2>
        <p class="card-text"><b><?php echo Text::_('COM_TEAMA_AGE')?> : </b><span></span> </p>
        <p class="card-text"><b><?php echo Text::_('COM_TEAMA_SEX')?> : </b><span></span></p>
        <p class="card-text"><b><?php echo Text::_('COM_TEAMA_DANGEROUSNESS')?> : </b><span></span></p>
        <p class="card-text"><b><?php echo Text::_('COM_TEAMA_COMMENTS')?> : </b><br><span></span></p>
    </div>
</div>

<?php