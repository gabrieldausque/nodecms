<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

\defined('_JEXEC') or die;

class TeamaModel extends \TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamaModel {

	public function __construct( $config = array(),
		MVCFactoryInterface $factory = null,
		FormFactoryInterface $formFactory = null ) {
		parent::__construct( $config, $factory, $formFactory );
	}

}