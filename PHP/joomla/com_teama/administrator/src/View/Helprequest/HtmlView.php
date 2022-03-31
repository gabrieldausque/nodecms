<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequest;

use A\B;
use TheLoneBlackSheep\Component\TeamA\Administrator\View\BodyField;

\defined('_JEXEC') or die;

class HtmlView
	extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem {

	public function __construct( $config = array() ) {
		parent::__construct(
			'Helprequest',
			'COM_TEAMA_CREATE_HELP_REQUEST_LABEL',
			'COM_TEAMA_EDIT_HELP_REQUEST_LABEL',
			$config );
        $this->addHeaderField('creation_date');
        $this->addHeaderField('request_datetime');
		$this->addHeaderField('requester_service');
		$this->addHeaderField('requester');
		$this->addBodyField(new BodyField('request_type'));
		$this->addBodyField(new BodyField('address'));
		$this->addBodyField(new BodyField('content'));
	}

}