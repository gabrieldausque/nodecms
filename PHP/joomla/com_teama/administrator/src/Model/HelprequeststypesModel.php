<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class HelprequeststypesModel extends TeamAListModel
{
    public function __construct($config = array(), MVCFactoryInterface $factory = null)
    {
        parent::__construct("filter_helprequeststypes",
            "#__teama_help_request_types", $config, $factory);
    }

	public function getItems()
	{
		return parent::getItems();
	}

	protected function getListQuery()
	{
		$searchTerms = $this->getState('filter.search');
		$dbo = $this->getDbo();

		$query = $dbo->getQuery(true);
		$query->select('*');
		$query->from($this->tableName);

		$whereClauses = [];

		if(isset($searchTerms) && trim($searchTerms) != ''){
			foreach (preg_split(',', $searchTerms) as $searchTerm){
				array_push($whereClauses, "name LIKE '%" . $searchTerm . "%'");
			}
		}

		$query->order(["id ASC"]);

		return $query;
	}
}