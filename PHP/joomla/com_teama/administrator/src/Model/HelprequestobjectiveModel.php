<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use DateTime;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class HelprequestobjectiveModel extends TeamAOneItemModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null)
	{
		parent::__construct(
			'com_teama.helprequestobjective',
			'helprequestobjective',
			$config, $factory, $formFactory);
		$this->pluralTypeName = 'helprequestobjectives';
		$this->typeName = 'helprequestobjective';
	}

	protected function getUnauthorizedEntity()
	{
		return [
			'id' => 0,
			'photo' => '',
			'lastname' => 'morgoth',
			'firstname' => 'sauron',
			'age' => 3000,
			'sex' => 'man',
			'birthdate' => new DateTime(),
			'birthplace' => 'Valinor',
			'size' => 220,
			'dangerousness' => 'high',
			'comment' => Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS')
		];
	}

	protected function getNewEntity()
	{
		return [
			'id' => 0,
			'photo' => '',
			'lastname' => '',
			'firstname' => '',
			'age' => 0,
			'sex' => Text::_('COM_TEAMA_MAN'),
			'birthdate' => new DateTime(),
			'birthplace' => 'Valinor',
			'size' => 220,
			'dangerousness' => 'high',
			'comment' => Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS')
		];
	}
}