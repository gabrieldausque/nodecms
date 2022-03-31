<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\OffshootsModel as BaseOffShootsModel;

class OffshootsModel
	extends BaseOffShootsModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null ) {
		parent::__construct($config, $factory);
		$this->typeName = 'offshoot';
		$this->pluralTypeName = 'offshoots';
	}

	protected function populateState( $ordering = null, $direction = null ) {
		parent::populateState( $ordering, $direction );
		$app = Factory::getApplication();
		$this->setState('params', $app->getParams());
	}

	public function getListQuery() {
		return parent::getListQuery(); 
	}

	public function getCanSearch() {
		return false;
	}
}