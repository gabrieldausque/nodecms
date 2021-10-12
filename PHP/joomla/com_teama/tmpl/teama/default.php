<?php

\defined('_JEXEC') or die ('Restricted Access');

use \Joomla\CMS\Language\Text;

?>

<section id="teama-news" class="teama-section">
    <div class="teama-section-title">
        <span class="teama-section-title-text">Actualités</span><span class="teama-section-title-decoration"></span>
    </div>
    <div class="teama-section-news ">
		<?php foreach($this->news as  $i => $oneNews) { ?>
            <article class="card">
                <h1><?php echo $oneNews->title?></h1>
            </article>
		<?php }?>
        <div class="link-to-all-news">
            <?php echo Text::_('COM_TEAMA_SHOW_ALL_NEWS') ?>
        </div>
    </div>
</section>

<section id="teama-newspaper" class="teama-section">
    <div class="teama-section-title">
        <span class="teama-section-title-text">Dans les journaux</span><span class="teama-section-title-decoration"></span>
    </div>
</section>

<?php //TODO : add services - members