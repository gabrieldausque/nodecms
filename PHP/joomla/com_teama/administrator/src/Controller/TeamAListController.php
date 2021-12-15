<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

abstract class TeamAListController
	extends BaseController
{
	public function __construct(string $typeName,
		string $defaultView,
		$config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null ) {
		parent::__construct( $config, $factory, $app, $input );
		$this->default_view = $defaultView;
		$this->typeName = $typeName;
	}

	public function delete($pks= []){
		$app = Factory::getApplication();
		$input = $app->getInput();
		$itemsToDelete = $input->get('selectedItemId');
		if(is_array($itemsToDelete) &&
		   count($itemsToDelete) > 0)
		{
			$model = $this->getModel();
			$model->delete($itemsToDelete);
			$app->enqueueMessage( Text::_('COM_TEAMA_' . strtoupper($this->typeName) . '_DELETED_MESSAGE'));
		}
		return $this->display();
	}
}