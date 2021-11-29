<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use \Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

// JHtml::_('script', 'com_teama/allnews_admin.js', ['version' => 'auto', 'relative' => true]);
?>

<form action="<?php echo Route::_('index.php?option=com_teama&task=departments.display'); ?>"
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
                <table class="table" id="teama-departments">
                    <thead>
                        <tr>
                            <td class="w-1 text-center">
                              <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </td>
                            <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                              <?php echo Text::_('COM_TEAMA_DEPARTMENTS_ID_FIELD') ?>
                            </th>
                            <th scope="col">
                                <?php echo Text::_('COM_TEAMA_DEPARTMENTS_NAME_FIELD')?>
                            </th>
                            <th scope="col">
		                        <?php echo Text::_('COM_TEAMA_DEPARTMENTS_NUMBER_FIELD')?>
                            </th>
                            <th scope="col">
                              <?php echo Text::_('COM_TEAMA_DEPARTMENTS_PATH_FIELD')?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n = count($this->items);
                        foreach($this->items as $i => $department) {
                            ?>

                          <tr class="row<?php echo $i % 2; ?>">
                              <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i, $department->id,
                                    false, 'selectedDepartmentsId', 'snb', $department->name); ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php echo $department->id ?>
                              </td>
                              <td class="has-context">
                                  <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                  <a class="hasToolTip" href="<?php echo Route::_('index.php?option=com_teama&task=department.edit&id=' . (int)$department->id); ?>"
                                     title="<?php echo Text::_('JACTION_EDIT') . ' ' . $this->escape(addslashes($department->name)) ?>"
                                  >
                                      <?php echo $editIcon . $this->escape($department->name); ?>
                                  </a>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                    echo $department->department_number;
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                    if(isset($department->path) && trim($department->summary) != '')
                                        echo 'the svg of the department';
                                    else
                                        echo 'no path';
                                ?>
                              </td>
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
            <input type="hidden" name="task" value="departments.display">
            <input type="hidden" name="boxchecked" value="0">
            <?php echo HTMLHelper::_('form.token')?>
          </div>
      </div>
  </div>
</form>

