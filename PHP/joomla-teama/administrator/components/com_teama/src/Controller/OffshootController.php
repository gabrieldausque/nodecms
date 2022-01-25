<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class OffshootController
	extends TeamAOneItemController {

	public function __construct(
		$config = array(),
		MVCFactoryInterface $factory = null,
		?CMSApplication $app = null,
		?Input $input = null,
		FormFactoryInterface $formFactory = null ) {
		parent::__construct(
			"offshoots",
			$config, $factory, $app, $input, $formFactory );
	}

}