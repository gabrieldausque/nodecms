<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class NewsModel
extends BaseDatabaseModel{

	protected $news;

	public function getTop5News() {
    $app = Factory::getApplication();
    $user = $app->getIdentity();

    if($user->authorise('news.read','com_teama')) {
      $db = $this->getDbo();
      $query = "SELECT * FROM #__teama_news ORDER BY creation_date DESC LIMIT 5 ";
      $db->setQuery($query);
      $this->news = $db->loadObjectList();
      foreach ($this->news as $onenews){
        $this->deserialize($onenews);
      }
    } else {
      $this->news = [
        new OneNews(true)
      ];
    }

    if(!is_array($this->news) || count($this->news) <= 0)
      $this->news =[
        new OneNews()
      ];

		return $this->news;
	}

  private function deserialize($onenews) {
    if(isset($onenews) && property_exists($onenews, 'header_media'))
      $onenews->header_media = json_decode($onenews->header_media);
  }

	public function getNews() {
		//todo manage errors

		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(['*']);
		$query->from($db->quoteName('#__teama_news'));

		$db->setQuery($query);
		$this->news = $db->loadObjectList();

		foreach ($this->news as $onenews){
			$this->deserialize($onenews);
		}

		return $this->news;
	}
}