<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class HelprequestobjectiveController
	extends TeamAOneItemController
{
		public function __construct($config = array(),
		                            MVCFactoryInterface $factory = null,
		                            ?CMSApplication $app = null,
		                            ?Input $input = null,
		                            FormFactoryInterface $formFactory = null)
		{
			parent::__construct('Helprequestobjectives', $config, $factory, $app, $input, $formFactory);
		}

		public function save($key = null, $urlVar = null)
		{
			return parent::save($key, $urlVar); // TODO: Change the autogenerated stub
		}
}