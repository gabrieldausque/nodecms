<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use DateTime;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

\defined('_JEXEC') or die;

class HelprequestModel
	extends TeamAOneItemModel {

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct(
			'com_teama.helprequest',
			'helprequest',
			$config, $factory, $formFactory );
		$this->pluralTypeName = 'helprequests';
		$this->typeName = 'helprequest';
	}

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
        return $item;
    }

    protected function getUnauthorizedEntity() {
		return [
			'id' => 0,
			'creation_date' => new DateTime(),
			'requester_service' => 'The ring fellowship',
			'requester' => 'Angmar',
			'content' => Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS'),
			'request_datetime' => new DateTime(),
			'address' => 'The moria mine',
			'difficulties' => 'Titan',
			'request_type' => 0
		];
	}

	protected function getNewEntity() {
		return [
			'id' => 0,
			'creation_date' => new DateTime(),
			'requester_service' => '',
			'requester' => '',
			'content' => '',
			'request_datetime' => new DateTime(),
			'address' => '',
			'difficulties' => '',
			'request_type' => 0
		];
	}
}