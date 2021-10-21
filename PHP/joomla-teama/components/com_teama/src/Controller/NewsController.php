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

	public function nextNews(){
	  if(!\JSession::checkToken('get')){
	    echo new \JResponseJson(null, \JText::_('JINVALID_TOKEN'), true);
    }
	  parent::display();
  }
}