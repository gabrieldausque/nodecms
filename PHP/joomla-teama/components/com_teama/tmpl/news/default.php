<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

\defined('_JEXEC') or die;

include __DIR__ . '/../headers/toolbar.php';

$app = Factory::getApplication();
$document = $app->getDocument();

JHtml::_('script', 'com_teama/allnews.js', ['version' => 'auto', 'relative' => true]);
$document->addStyleSheet('/media/com_teama/css/allnews.css');

?>
<div class="teama-section">
    <div class="teama-allnews-title text-white">
        <div class="teama-allnews-title-text"><?php echo Text::_('COM_TEAMA_NEWS_TITLE') ?>
        </div><div class="teama-section-title-decoration sm"></div>
    </div>
    <div class="teama-section-news">
      <?php foreach($this->news as  $i => $oneNews) { ?>
          <article id="teama-news-<?php echo $oneNews->id ?>" class="card teama-news-card" data-newslink="index.php?option=com_teama&task=onenews.display&view=onenews&id=<?php echo $oneNews->id ?>">
            <?php if(isset($oneNews->header_media->image) &&
                     $oneNews->header_media->image != "") { ?>
                <div class="card-img-top"
                     style="background-image: url('<?php echo $oneNews->header_media->image ?>');
                             background-position: center;
                             background-repeat: no-repeat;
                             background-size: contain;
                             width: 100%;
                             height: 100px;"
                     alt="<?php echo $oneNews->header_media->alt?>"
                     title="<?php echo $oneNews->header_media->caption ?>"
                ></div>
            <?php } ?>
              <div class="card-body">
                  <h5><?php echo $oneNews->title?></h5>
                  <p class="card-text"><?php echo $oneNews->summary ?></p>
              </div>
          </article>
      <?php }?>
        <div id="next-news" class="card teama-news-card link-to-all-news"
             data-start="<?php echo $this->pagination->getPaginationPages()['next']['data']->base ?>"
             data-token="<?php echo JSession::getFormToken() ?>"
        >
          <?php echo Text::_('COM_TEAMA_SHOW_NEXT_NEWS') ?>
        </div>
    </div>
</div>
<article id="teama-news-tmpl"
         class="card teama-news-card hidden"
         data-newslink="index.php?option=com_teama&task=onenews.display&view=onenews&id=">
      <div class="card-img-top"
           style="background-image: url('');
                   background-position: center;
                   background-repeat: no-repeat;
                   background-size: contain;
                   width: 100%;
                   height: 100px;"
           alt=""
           title=""
      ></div>
    <div class="card-body">
        <h5 id="teama-thenews-title"></h5>
        <p id="teama-thenews-summary" class="card-text"></p>
    </div>
</article>
