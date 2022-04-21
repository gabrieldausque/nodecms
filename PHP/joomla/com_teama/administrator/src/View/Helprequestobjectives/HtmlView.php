<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequestobjectives
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequestobjectives;

use http\Header;
use TheLoneBlackSheep\Component\TeamA\Administrator\View\HeaderField;

class HtmlView extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList
{

	public function __construct($config = array())
	{
		parent::__construct('COM_TEAMA_MANAGER_HELP_REQUEST_OBJECTIVES',
			'helprequestobjectives',
			'helprequestobjective', $config);
		$this->addFieldToDisplay(new HeaderField('lastname', 'COM_TEAMA_LASTNAME'));
		$this->addFieldToDisplay(new HeaderField('firstname', 'COM_TEAMA_FIRSTNAME'));
		$this->addFieldToDisplay(new HeaderField('age', 'COM_TEAMA_AGE'));
		$this->addFieldToDisplay(new HeaderField('sex', 'COM_TEAMA_SEX'));
		$this->addFieldToDisplay(new HeaderField('birthdate', 'COM_TEAMA_BIRTHDATE'));
		$this->addFieldToDisplay(new HeaderField('birthplace', 'COM_TEAMA_BIRTHPLACE'));
		$this->addFieldToDisplay(new HeaderField('size', 'COM_TEAMA_SIZE'));
		$this->addFieldToDisplay(new HeaderField('dangerousness', 'COM_TEAMA_DANGEROUSNESS'));
	}

	function getItemName($item)
	{
		return $item->lastname . ' ' . $item->firstname;
	}
}