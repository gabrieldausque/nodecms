<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequeststype
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequeststype;

use TheLoneBlackSheep\Component\TeamA\Administrator\View\BodyField;

\defined('_JEXEC') or die;

class HtmlView extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem
{
	public function __construct($config = array())
	{
		parent::__construct("Helprequeststype",
			"COM_TEAMA_CREATE_HELP_REQUEST_TYPE_LABEL",
			"COM_TEAMA_EDIT_HELP_REQUEST_TYPE_LABEL", $config);
		$this->addBodyField(new BodyField('name'));
	}
}