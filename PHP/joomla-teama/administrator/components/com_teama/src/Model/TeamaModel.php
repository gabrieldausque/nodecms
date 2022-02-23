<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

\defined('_JEXEC') or die('Access Restricted');

class TeamaModel extends TeamAListModel {

	public function __construct( $config = array(),
		MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( 'com_teama.teama',
			'teama', $config, $factory, $formFactory );
	}

}