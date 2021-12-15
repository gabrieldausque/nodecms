<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class OffshootsController
	extends BaseController {

	protected $default_view = 'Offshoots';

	public function delete($pks= []){
		$app = Factory::getApplication();
		$input = $app->getInput();
		$offShootsToDelete = $input->get('selectedItemId');
		if(is_array($offShootsToDelete) &&
		   count($offShootsToDelete) > 0)
		{
			$model = $this->getModel();
			$model->delete($offShootsToDelete);
			$app->enqueueMessage("Offshoots has been deleted");
		}
		return $this->display();
	}
}