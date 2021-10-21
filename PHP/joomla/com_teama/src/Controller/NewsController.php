<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class NewsController
	extends BaseController
{
	protected $default_view = 'News';

	public function display( $cachable = false, $urlparams = array() ) {
		return parent::display( $cachable, $urlparams );
	}
}