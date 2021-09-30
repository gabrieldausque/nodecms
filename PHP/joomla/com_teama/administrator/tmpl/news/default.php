<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;

$app = Factory::getApplication();

?>

<form action="<?php echo Route::_('index.php?option=com_teama'); ?>"
    method="post"
    name="adminForm"
    id="adminForm"
>
  <div class="row">
      <div class="col-md-12">
          <div id="j-main-container" class="j-main-container">
              <?php if(empty($this->teamaNews)) { ?>
                <div class="alert alert-warning">
                    <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                </div>
              <?php } else { ?>
                <table class="table" id="teama-news">
                    <thead>
                        <tr>
                            <th scope="col">
                                <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_TITLE')?>
                            </th>
                            <th scope="col">
                                <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_AUTHOR')?>
                            </th>
                            <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                              <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_ID') ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n = count($this->teamaNews);
                        foreach($this->teamaNews as $i => $news) {
                            ?>
                          <tr class="row<?php echo $i % 2; ?>">
                              <th scope="row" class="has-context">
                                  <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                  <a class="hasToolTip" href="<?php echo Route::_('index.php?option=com_teama&task=onenews.edit&id=' . (int)$news->id); ?>"
                                     title="<?php echo Text::_('JACTION_EDIT') . ' ' . $this->escape(addslashes($news->title)) ?>"
                                  >
                                      <?php echo $editIcon . $this->escape($news->title); ?>
                                  </a>
                              </th>
                              <td class="d-none d-md-table-cell">
                                <?php
                                $author = Factory::getContainer()->get(\Joomla\CMS\User\UserFactoryInterface::class)->loadUserById($news->author);
                                echo $author->name;
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                  <?php echo $news->id ?>
                              </td>
                          </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
              <?php
              }
              ?>
            <input type="hidden" name="task" value="">
            <input type="hidden" name="boxchecked" value="0">
            <?php echo HTMLHelper::_('form.token')?>
          </div>
      </div>
  </div>
</form>

