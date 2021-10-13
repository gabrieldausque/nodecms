<?php

\defined('_JEXEC') or die ('Restricted Access');

use \Joomla\CMS\Language\Text;

?>

<section id="teama-news" class="teama-section">
    <div class="teama-section-title">
        <span class="teama-section-title-text"><?php echo Text::_('COM_TEAMA_NEWS_TITLE') ?></span>
        <span class="teama-section-title-decoration sm"></span>
        <span class="teama-section-title-decoration"></span>
    </div>
    <div class="teama-section-news ">
		<?php foreach($this->news as  $i => $oneNews) { ?>
            <article class="card teama-news-card">
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
                    ></div>
                <?php } ?>
                <div class="card-body">
                    <h5><?php echo $oneNews->title?></h5>
                    <p class="card-text"><?php echo $oneNews->summary ?></p>
                </div>
            </article>
		<?php }?>
        <div class="link-to-all-news">
            <?php echo Text::_('COM_TEAMA_SHOW_ALL_NEWS') ?>
        </div>
    </div>
</section>

<section id="teama-newspaper" class="teama-section">
    <div class="teama-section-title">
        <span class="teama-section-title-text">Dans les journaux</span>
        <span class="teama-section-title-decoration sm"></span>
        <span class="teama-section-title-decoration"></span>
    </div>
</section>

<?php //TODO : add services - members