<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Pagination\Pagination;
use TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\Actions;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\NewsModel as BaseNewsDatabaseModel;

class NewsModel
  extends BaseNewsDatabaseModel{

  public static string $TABLE_NAME = '#__teama_news';

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

	public function getNews() {
    $query = $this->getListQuery();
    $this->news = $this->_getList($query);
		foreach ($this->news as $onenews){
			$this->deserialize($onenews);
		}
		return $this->news;
	}

  public function getActions(){
    $app = Factory::getApplication();
    $user = $app->getIdentity();

    $actions = [];

    if($user->authorise('news.create','com_teama'))
    {
      array_push($actions, new Actions(
        'create',
        'index.php?option=com_teama&view=onenews&layout=edit'
      ));
    }

    return $actions;
  }

  public function getCanSearch(){
    return true;
  }

}