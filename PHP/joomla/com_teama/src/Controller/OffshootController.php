<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;
use TheLoneBlackSheep\Component\TeamA\Administrator\Controller\OffshootController as BaseOffshootController;

class OffshootController
	extends BaseOffshootController
{
	public function __construct( $config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( $config, $factory, $app, $input, $formFactory );
	}
}