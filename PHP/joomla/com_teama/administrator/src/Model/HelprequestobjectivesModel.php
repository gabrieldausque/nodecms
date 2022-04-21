<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class HelprequestobjectivesModel extends TeamAListModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null)
	{
		parent::__construct('filter_helprequestobjectives',
			'#__teama_help_requests_objectives', $config, $factory);
	}

	protected function getListQuery()
	{
		$dbo = $this->getDbo();

		$query = $dbo->getQuery(true);
		$query->select('*');
		$query->from($this->tableName);

		return $query;
	}

	public function getCanSearch()
	{
		return false;
	}
}