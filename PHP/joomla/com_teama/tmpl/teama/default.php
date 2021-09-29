<?php

\defined('_JEXEC') or die ('Restricted Access');

?>

<section id="teama-news">
    <div class="teama-section-title">Actualités</div>
    <div>
		<?php foreach($this->news as  $i => $oneNews) { ?>
            <article>
                <h1><?php echo $oneNews->title?></h1>
            </article>
		<?php }?>
    </div>
</section>

<section id="teama-newspaper">
    <div class="teama-section-title">Dans les médias</div>

</section>