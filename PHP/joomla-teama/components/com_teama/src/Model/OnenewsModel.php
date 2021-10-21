<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use TheLoneBlackSheep\Component\TeamA\Site\Model\OneNews;

class OnenewsModel extends BaseDatabaseModel {

  protected $item;

  protected function populateState() {
    $app = Factory::getApplication();

    // Load state from the request.
    $pk = $app->input->getInt('id');
    $this->setState('news.id', $pk);
  }

  private function deserialize($onenews) {
    if(isset($onenews) && property_exists($onenews, 'header_media'))
      $onenews->header_media = json_decode($onenews->header_media);
  }

  public function getItem($pk = null){
    $app = Factory::getApplication();
    $user = $app->getIdentity();

    $pk = (int) ($pk ?: $this->getState('news.id'));

    if(!isset($user))
      die("You must be a registered user");

    $theNews = null;

    if($user->authorise('news.read','com_teama'))
    {
      $db = $this->getDbo();
      $query = 'SELECT * FROM #__teama_news WHERE id=' . $pk;
      $db->setQuery($query);
      $theNews = $db->loadObject();
      if(isset($theNews))
        $this->deserialize($theNews);
    } else
      $theNews = new OneNews(true);

    if(!isset($theNews))
      $theNews = new OneNews();
    $this->item = $theNews;
    return $this->item;
  }

}