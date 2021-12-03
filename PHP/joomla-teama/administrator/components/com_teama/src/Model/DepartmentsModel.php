<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class DepartmentsModel
	extends TeamAListModel
{
	public function __construct($config = [], MVCFactoryInterface $factory = NULL) {
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = [
				'name','a.name'
			];
		}
		$this->paginationLimit = 20;
		parent::__construct($config, $factory);
	}

	protected $filterFormName = 'filter_departments';

	protected function getListQuery() {
		$filter = $this->getState("filter.search");

		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select("*")
			->from("#__teama_departments");
		if(isset($filter)){
			$query->where('name = "'. $filter . '"');
			if(is_numeric($filter))
				$query->where('department_number = ' . $filter);
		}
		$query->order('department_number');
		if(isset($this->pagination))
			$query->setLimit($this->pagination->limit,$this->pagination->limitstart);
		return $query;
	}

	protected function getEmptyStateQuery() {
		return "SELECT * FROM #__teama_departments WHERE 1=0";
	}

	public function delete($pks = []){
		if(is_array($pks) && count($pks) > 0){
			$db = $this->getDbo();
			$query = "DELETE #__teama_departments FROM #__teama_departments 
				WHERE ID IN (" . implode(',', $pks) . ")";
			$db->setQuery($query);
			$db->execute();
		}
	}
}