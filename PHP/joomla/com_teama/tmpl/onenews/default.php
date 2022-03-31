<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

\defined('_JEXEC') or die ('Restricted Access');

use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Factory;
use Joomla\CMS\User\UserFactoryInterface;

include __DIR__ . '/../headers/toolbar.php';

$theNews = $this->item;
$theNews = $this->item;
$app = Factory::getApplication();
$document = $app->getDocument();
$userFactory = Factory::getContainer()->get(UserFactoryInterface::class);
$author = $userFactory->loadUserById($theNews->author);
$modifier = $author;
if(isset($theNews->last_modifier))
  $modifier = $userFactory->loadUserById($theNews->last_modifier);
$document->addStyleSheet('/media/com_teama/css/onenews.css');

$user = $app->getIdentity();
$isAuthenticate = !$user->guest;

if($isAuthenticate) {
?>

<article class="teama-onenews">
    <div class="h-100 p-5 bg-light rounded-3 border teama-onenews-header">
        <div class="display-4 teama-onenews-title"><?php echo $theNews->title ?></div>
          <?php if(isset($theNews->header_media) && trim($theNews->header_media['image']) != '') {?>
              <div class="teama-onenews-header-image"
                   style="background-image: url('<?php echo $theNews->header_media["image"] ?>')"
                   title="<?php echo $theNews->header_media["caption"] ?>"
              ></div>
          <?php } ?>
        <hr class="my-4">
        <p class="teama-onenews-summary lead"><b><?php echo $theNews->summary ?></b></p>
    </div>
    <div class="teama-onenews-content"><?php echo $theNews->body ?></div>
    <footer class="teama-onenews-footer">
          <p><b><?php echo Text::_('COM_TEAMA_WRITTEN_BY')  ?> :</b> <?php echo $author->name ?></p>
          <p><b><?php echo Text::_('COM_TEAMA_WRITTEN_WHEN')  ?> :</b> <?php echo $theNews->creation_date ?></p>
          <p><b><?php echo Text::_('COM_TEAMA_MODIFIED_BY')  ?> :</b> <?php echo $modifier->name ?></p>
          <p><b><?php echo Text::_('COM_TEAMA_MODIFIED_WHEN')  ?> :</b> <?php echo $theNews->modification_date ?></p>
          <p><b>Tags : </b><?php echo $theNews->tags ?></p>
    </footer>
</article>

<?php
}