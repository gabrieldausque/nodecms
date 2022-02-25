<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\Component\Contact\Site\Model\CategoryModel;
use Joomla\Component\Users\Administrator\Model\GroupModel;
use TheLoneBlackSheep\Component\TeamA\Administrator\Helpers\UserHelpers;

class OffshootModel
	extends TeamAOneItemModel {

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( 'com_teama.offshoot',
			'offshoot', $config, $factory, $formFactory );
		$this->pluralTypeName = 'offshoots';
		$this->typeName = 'offshoot';
	}

	protected function getUnauthorizedEntity() {
		return [
			'id' => 0,
			'name' => Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS'),
			'address' => 'Mordor',
			'phone_number' => '66.66.66.66.66',
			'mail' => 'youshall@notpass.com'
		];
	}

	protected function getNewEntity() {
		return [
			'id' => 0,
			'name' => '',
			'address' => '',
			'phone_number' => '',
			'mail' => ''
		];
	}

}