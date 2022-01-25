<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class TeamAOneItemController
	extends FormController
{
	public function __construct(string $viewList,
		$config = array(),
		MVCFactoryInterface $factory = null,
		?CMSApplication $app = null,
		?Input $input = null,
		FormFactoryInterface $formFactory = null ) {
		parent::__construct( $config,
			$factory,
			$app,
			$input,
			$formFactory );
		$this->view_list = $viewList;
	}
}