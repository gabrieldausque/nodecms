<?php

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use \Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

JHtml::_('script', 'com_teama/allnews_admin.js', ['version' => 'auto', 'relative' => true]);
?>

<form action="<?php echo Route::_('index.php?option=com_teama&task=news.display'); ?>"
    method="post"
    name="adminForm"
    id="adminForm"
>
  <div class="row">
      <div class="col-md-12">
          <div id="j-main-container" class="j-main-container">
              <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]);?>
              <?php if(empty($this->teamaNews)) { ?>
                <div class="alert alert-warning">
                    <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                </div>
              <?php } else { ?>
                <table class="table" id="teama-news">
                    <thead>
                        <tr>
                            <td class="w-1 text-center">
                              <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </td>
                            <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                              <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_ID') ?>
                            </th>
                            <th scope="col">
                                <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_TITLE')?>
                            </th>
                            <th scope="col">
                                <?php echo Text::_('COM_TEAMA_NEWS_TABLE_HEAD_AUTHOR')?>
                            </th>
                            <th scope="col">
                              <?php echo Text::_('COM_TEAMA_NEWS_CREATION_DATE_FIELD')?>
                            </th>
                            <th scope="col">
                              <?php echo Text::_('COM_TEAMA_NEWS_MODIFICATION_DATE_FIELD')?>
                            </th>
                            <th scope="col">
                              <?php echo Text::_('COM_TEAMA_NEWS_SUMMARY_FIELD')?>
                            </th>
                            <th scope="col">
                              <?php echo Text::_('COM_TEAMA_NEWS_TAGS_FIELD')?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n = count($this->teamaNews);
                        foreach($this->teamaNews as $i => $news) {
                            ?>

                          <tr class="row<?php echo $i % 2; ?>">
                              <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i, $news->id, false, 'selectedNewsId', 'snb', $news->title); ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php echo $news->id ?>
                              </td>
                              <td class="has-context">
                                  <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                  <a class="hasToolTip" href="<?php echo Route::_('index.php?option=com_teama&task=onenews.edit&id=' . (int)$news->id); ?>"
                                     title="<?php echo Text::_('JACTION_EDIT') . ' ' . $this->escape(addslashes($news->title)) ?>"
                                  >
                                      <?php echo $editIcon . $this->escape($news->title); ?>
                                  </a>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                $author = Factory::getContainer()->get(\Joomla\CMS\User\UserFactoryInterface::class)->loadUserById($news->author);
                                echo $author->name;
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                    echo $news->creation_date;
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                    echo $news->modification_date;
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell" title="<?php echo $news->summary ?>">
                                <?php
                                    if(isset($news->summary) && trim($news->summary) != '')
                                        echo substr($news->summary,0,25) . '...';
                                ?>
                              </td>
                              <td class="d-none d-md-table-cell">
                                <?php
                                    if(isset($news->tags) && trim($news->tags) != '')
                                        echo $news->tags;
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
            <input type="hidden" name="task" value="news.display">
            <input type="hidden" name="boxchecked" value="0">
            <?php echo HTMLHelper::_('form.token')?>
          </div>
      </div>
  </div>
</form>

