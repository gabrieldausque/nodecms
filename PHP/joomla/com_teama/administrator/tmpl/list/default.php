<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use \Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

JHtml::_('script', 'com_teama/' . $this->item_type . '_admin.js', ['version' => 'auto', 'relative' => true]);
?>

<form action="<?php echo Route::_('index.php?option=com_teama&task='. $this->item_type .'.display'); ?>"
      method="post"
      name="adminForm"
      id="adminForm"
>
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);?>
				<?php if(empty($this->items)) { ?>
					<div class="alert alert-warning">
						<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
					</div>
				<?php } else { ?>
					<table class="table" id="teama-<?php echo $this->item_type ?>">
						<thead>
						<tr>
							<td class="w-1 text-center">
								<?php echo HTMLHelper::_('grid.checkall'); ?>
							</td>
							<th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
								<?php echo Text::_('COM_TEAMA_TABLE_HEAD_ID') ?>
							</th>
							<?php foreach($this->fields_to_display as $field) { ?>
								<th scope="col">
									<?php echo Text::_($field->label)?>
								</th>
							<?php } ?>
						</tr>
						</thead>
						<tbody>
						<?php
						$n = count($this->items);
						foreach($this->items as $i => $item) {
							?>
							<tr class="row<?php echo $i % 2; ?>">
								<td class="text-center">
									<?php echo HTMLHelper::_('grid.id', $i, $item->id, false,
                                        'selectedItemId',
                                        'snb', $this->getItemName($item)); ?>
								</td>
								<td class="d-none d-md-table-cell">
									<?php echo $item->id ?>
								</td>
								<td class="has-context">
									<?php $editIcon = '<span class="fa fa-pencil-square mr-2" 
									aria-hidden="true"></span>'; ?>
									<a class="hasToolTip" href="<?php echo Route::_('index.php?option=com_teama&task=' .
                                                                                    $this->item_single_name . '.edit&id=' .
                                                                                    (int)$item->id); ?>"
									   title="<?php echo Text::_('JACTION_EDIT') . ' ' .
									                     $this->escape(addslashes($this->getItemName($item))) ?>"
									>
										<?php echo $editIcon . $this->escape($this->getItemName($item)); ?>
									</a>
								</td>
								<?php foreach ($this->fields_to_display as $field) { ?>
								<td class="d-none d-md-table-cell">
									<?php
										echo $item->{$field->name};
									?>
								</td>
								<?php } ?>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<?php
					echo $this->pagination->getListFooter();
				}
				?>
				<input type="hidden" name="task" value="<?php echo $this->item_type ?>.display">
				<input type="hidden" name="boxchecked" value="0">
				<?php echo HTMLHelper::_('form.token')?>
			</div>
		</div>
	</div>
</form>

