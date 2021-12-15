<?php
namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Offshoot;

\defined('_JEXEC') or die;

use TheLoneBlackSheep\Component\TeamA\Administrator\View\BodyField;
use TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem;

class HtmlView
	extends TeamAViewOneItem {

	public function __construct($config = array() ) {
		parent::__construct(
			'Offshoot',
			'COM_TEAMA_CREATE_OFFSHOOT_LABEL',
			'COM_TEAMA_EDIT_OFFSHOOT_LABEL',
			$config );
		$this->addHeaderField('name');
		$this->addBodyField(new BodyField('address'));
		$this->addBodyField(new BodyField('phone_number'));
		$this->addBodyField(new BodyField('mail'));
	}

}