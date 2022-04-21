<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class HelprequestModel
	extends \TheLoneBlackSheep\Component\TeamA\Administrator\Model\HelprequestModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null)
	{
		parent::__construct($config, $factory, $formFactory);
		$this->typeName = 'helprequest';
		$this->pluralTypeName = 'helprequests';
	}


}