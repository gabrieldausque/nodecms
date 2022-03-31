<?php

\defined('_JEXEC') or die ('Restricted Access');

use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Application\WebApplication;

$app = Factory::getApplication();
$document = $app->getDocument();

include __DIR__ . '/../headers/toolbar.php';

JHtml::_('script', 'com_teama/home.js', ['version' => 'auto', 'relative' => true]);

$user = $app->getIdentity();
$isAuthenticate = !$user->guest;

if($isAuthenticate) {
?>

<section id="teama-news" class="teama-section">
    <div class="teama-section-title">
        <span class="teama-section-title-text"><?php echo Text::_('COM_TEAMA_NEWS_TITLE') ?></span>
        <span class="teama-section-title-decoration sm"></span>
        <span class="teama-section-title-decoration"></span>
    </div>
    <div class="teama-section-news ">
		<?php foreach($this->news as  $i => $oneNews) { ?>
            <article class="card teama-news-card" data-newslink="index.php?option=com_teama&task=onenews.display&view=onenews&id=<?php echo $oneNews->id ?>">
	            <?php
	            if($this->isRhNews($oneNews)){
		            ?><div class="badge bg-success">RH</div><?php
	            }

	            if(isset($oneNews->header_media->image) &&
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
                    <h5><?php echo $oneNews->title?> </h5>
                    <p class="card-text"><?php echo $oneNews->summary ?></p>
                </div>
            </article>
		<?php }?>
        <div class="card teama-news-card link-to-all-news" data-newslink="index.php?option=com_teama&task=news.display&view=news">
            <?php echo Text::_('COM_TEAMA_SHOW_ALL_NEWS') ?>
        </div>
    </div>
</section>

<?php
}