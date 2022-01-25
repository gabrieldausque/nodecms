<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\Route;
use Joomla\Input\Input;
use TheLoneBlackSheep\Component\TeamA\Administrator\Controller\TeamAOneItemController;

abstract class TeamAOneItemFrontEndController
	extends TeamAOneItemController
{
	protected string $pluralTypeName;

	protected string $typeName;

	public function __construct( string $viewList,
		string $typeName,
		string $pluralTypeName,
		$config = array(),
		MVCFactoryInterface $factory = null,
		?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( $viewList, $config, $factory, $app, $input, $formFactory );
		$this->pluralTypeName = strtolower($pluralTypeName);
		$this->typeName = strtolower($typeName);
	}

	public function allowEdit($data = [], $key = 'id') {
		$app = Factory::getApplication();
		$user = $app->getIdentity();
		if(isset($user)){
			return $user->authorise($this->pluralTypeName . '.edit','com_teama');
		}
		return false;
	}

	public function allowAdd($data = []) {
		$app = Factory::getApplication();
		$user = $app->getIdentity();
		if(isset($user)){
			return $user->authorise($this->pluralTypeName . '.create',
				'com_teama');
		}
		return false;
	}

	public function delete(){
		$model = $this->getModel();
		$url = 'index.php?option=' . $this->option . '&view=' . $this->view_list
		       . $this->getRedirectToListAppend();
		$app = Factory::getApplication();
		$input = $app->getInput();
		$id = $input->getInt('id');
		if(isset($id)){
			$ids = [
				$id
			];
			if($model->delete($ids)){
				$app->enqueueMessage(Text::_('COM_TEAMA_DELETE_OK_MESSAGE'), $app::MSG_NOTICE);
			} else {
				$url = 'index.php?option=' . $this->option . '&view=' . $this->default_view
				       . '&task=' . $this->typeName . '.display&id=' . $id;
			}
			$this->setRedirect(Route::_($url, false));
		}
	}

}