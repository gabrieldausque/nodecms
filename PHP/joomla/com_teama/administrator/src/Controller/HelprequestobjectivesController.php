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
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class HelprequestobjectivesController extends TeamAListController
{

	public function __construct($config = array(),
	                            MVCFactoryInterface $factory = null,
	                            ?CMSApplication $app = null,
	                            ?Input $input = null)
	{
		parent::__construct('Helprequestobjectives', 'Helprequestobjectives', $config, $factory, $app, $input);
	}
}