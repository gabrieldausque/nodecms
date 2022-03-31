<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class NewsController
	extends BaseController
{
	protected $default_view = 'News';

	public function display( $cachable = false, $urlparams = [] ) {
		return parent::display( $cachable, $urlparams );
	}

	public function delete($pks= []){
	  $app = Factory::getApplication();
	  $input = $app->getInput();
	  $newsToDelete = $input->get('selectedNewsId');
	  if(is_array($newsToDelete) && count($newsToDelete) > 0){
	    $model = $this->getModel();
	    $model->delete($newsToDelete);
	    $app->enqueueMessage("News has been deleted");
    }
	  return $this->display();
  }
}