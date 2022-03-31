<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class HelprequeststypeModel extends TeamAOneItemModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null)
	{
		parent::__construct("com_teama.helprequeststype",
			"helprequeststype", $config, $factory, $formFactory);
		$this->pluralTypeName = "helprequeststypes";
		$this->typeName = "helprequeststype";
	}

	protected function getUnauthorizedEntity()
	{
		return [
			'id'=>0,
			'name'=>Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS'),
		];
	}

	protected function getNewEntity()
	{
		return [
			'id'=>0,
			'name'=>''
		];
	}
}