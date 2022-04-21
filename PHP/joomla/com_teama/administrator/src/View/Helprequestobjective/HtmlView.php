<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequestobjective;

use A\B;
use TheLoneBlackSheep\Component\TeamA\Administrator\View\BodyField;

\defined('_JEXEC') or die;

class HtmlView
	extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem {

	public function __construct( $config = array() ) {
		parent::__construct(
			'Helprequestobjective',
			'COM_TEAMA_CREATE_HELP_REQUEST_OBJECTIVE_LABEL',
			'COM_TEAMA_EDIT_HELP_REQUEST_OBJECTIVE_LABEL',
			$config );
        $this->addHeaderField('photo');
        $this->addHeaderField('lastname');
		$this->addHeaderField('firstname');
		$this->addBodyField(new BodyField('age'));
		$this->addBodyField(new BodyField('sex'));
		$this->addBodyField(new BodyField('birthdate'));
		$this->addBodyField(new BodyField('birthplace'));
		$this->addBodyField(new BodyField('size'));
		$this->addBodyField(new BodyField('dangerousness'));
		$this->addBodyField(new BodyField('comment'));
	}

}