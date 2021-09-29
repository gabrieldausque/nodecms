<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class NewsModel
extends BaseDatabaseModel{

	protected $news;

	public function getNews() {
		//todo manage errors

		$db = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select(['*']);
		$query->from($db->quoteName('#__teama_news'));

		$db->setQuery($query);
		$this->news = $db->loadObjectList();

		return $this->news;
	}
}