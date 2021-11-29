<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class DepartmentsController
	extends BaseController
{
	protected $default_view = 'Departments';

	public function delete($pks= []){
		$app = Factory::getApplication();
		$input = $app->getInput();
		$departmentsToDelete = $input->get('selectedDepartmentsId');
		if(is_array($departmentsToDelete) && count($departmentsToDelete) > 0){
			$model = $this->getModel();
			$model->delete($departmentsToDelete);
			$app->enqueueMessage("Departments has been deleted");
		}
		return $this->display();
	}

}