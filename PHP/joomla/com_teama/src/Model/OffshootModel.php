<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class OffshootModel
	extends TeamAOneItemFrontEndModel
{

	public function __construct(
		$config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct(
			'offshoot',
			'offshoots',
			'com_teama.offshoot',
			'offshoot',
			$config, $factory, $formFactory );
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