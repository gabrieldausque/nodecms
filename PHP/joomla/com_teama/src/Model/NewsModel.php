<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Pagination\Pagination;
use TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\Actions;

class NewsModel
extends BaseDatabaseModel{

  public static string $TABLE_NAME = '#__teama_news';

	protected $news;

	protected Pagination $pagination;

  /**
   *
   * @return mixed
   *
   * @since version
   */
  public function getTotal() {
    $db    = $this->getDbo();
    $query = $db->getQuery(TRUE);
    $query->select('count(id) as nb');
    $query->from(self::$TABLE_NAME);
    $total = $db->setQuery($query)->loadObject()->nb;
    return $total;
  }

  protected function populateState() {
    $app = Factory::getApplication();
    $this->setState('start', $app->input->getInt('start', 0));
    $this->setState('limit', 8);
  }

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

  public function getPagination() {
    $pageIndex = $this->getState('start');
    $limit = $this->getState('limit');
    $start = $this->getState('start');
    $total     = $this->getTotal();
    $this->pagination = new Pagination($total, $start, $limit);
	  return $this->pagination;
  }

	public function getNews() {
    $this->getPagination();
		$db = $this->getDbo();
    $query = $db->getQuery(true);
    $query->select('*')
          ->from(self::$TABLE_NAME)
          ->order('id DESC')
          ->setLimit($this->pagination->limit,$this->pagination->limitstart);
    $db->setQuery($query);
    $this->news = $db->loadObjectList();
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

}