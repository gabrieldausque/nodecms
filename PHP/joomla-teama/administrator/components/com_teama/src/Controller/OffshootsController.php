<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class OffshootsController
	extends TeamAListController {

	public function __construct($config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null ) {
		parent::__construct( 'Offshoots',
			'Offshoots',
			$config,
			$factory,
			$app, $input );
	}
}