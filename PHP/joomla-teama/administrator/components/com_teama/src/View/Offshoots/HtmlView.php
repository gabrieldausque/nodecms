<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Offshoots;

\defined('_JEXEC') or die;

use TheLoneBlackSheep\Component\TeamA\Administrator\View\HeaderField;
use \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList;

class HtmlView
	extends TeamAViewList {

	public function __construct($config = array()) {
		parent::__construct( 'COM_TEAMA_MANAGER_OFFSHOOTS',
			'offshoots',
			'offshoot',
			$config );
		$this->addFieldToDisplay(new HeaderField('name', 'COM_TEAMA_TABLE_HEAD_NAME'));
		$this->addFieldToDisplay(new HeaderField('address', 'COM_TEAMA_TABLE_HEAD_ADDRESS'));
		$this->addFieldToDisplay(new HeaderField('phone_number', 'COM_TEAMA_TABLE_HEAD_PHONE'));
		$this->addFieldToDisplay(new HeaderField('mail', 'COM_TEAMA_TABLE_HEAD_MAIL'));
	}

	function getItemName( $item ) {
		return $item->name;
	}
}