<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class TeamaModel
	extends BaseDatabaseModel
{
	protected $news;

	public function getNews()
	{
		$app = Factory::getApplication();
		$this->news = $app->input->get('show_text', "My First News");

		return $this->news;
	}
}