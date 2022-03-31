<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Table
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Table;

use Joomla\Database\DatabaseDriver;
use Joomla\Event\DispatcherInterface;

class HelprequeststypeTable extends \Joomla\CMS\Table\Table
{

	public function __construct(DatabaseDriver $db, DispatcherInterface $dispatcher = null)
	{
		$this->typeAlias = "com_teama.helprequeststype";
		parent::__construct("#__teama_help_request_types", "id", $db, $dispatcher);
	}

}