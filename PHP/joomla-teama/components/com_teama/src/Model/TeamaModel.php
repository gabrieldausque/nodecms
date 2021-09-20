<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class TeamaModel
	extends BaseDatabaseModel
{
	protected $news;

	public function getNews()
	{
		if(!isset($this->news)){
			$this->news = 'Hello News !';
		}

		return $this->news;
	}
}