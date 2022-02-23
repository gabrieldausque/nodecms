<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\OffshootModel as BaseOffshootModel;

class OffshootModel
	extends BaseOffshootModel
{
	public function __construct(
		$config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct($config,$factory,$formFactory);
		$this->typeName = 'offshoot';
		$this->pluralTypeName = 'offshoots';
	}

}