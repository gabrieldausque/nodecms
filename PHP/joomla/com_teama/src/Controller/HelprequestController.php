<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

\defined('_JEXEC') or die;

class HelprequestController
	extends \TheLoneBlackSheep\Component\TeamA\Administrator\Controller\HelprequestController
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null)
	{
		parent::__construct($config, $factory, $app, $input, $formFactory);
	}
}