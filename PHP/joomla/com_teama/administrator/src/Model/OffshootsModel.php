<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ListModel;

class OffshootsModel
	extends TeamAListModel {

	public function __construct($config = [],
		MVCFactoryInterface $factory = NULL) {
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = [
				'name','a.name',
				'address','a.address'
			];
		}
		parent::__construct('filter_offshoots',
			'#__teama_offshoots',
			$config, $factory);
	}

	protected function getListQuery() {
		$filterByName = $this->getState('filter.name');
		$filterByAddress = $this->getState('filter.address');
		$searchTerms = $this->getState('filter.search');

		$dbo = $this->getDbo();

		$query = $dbo->getQuery(true);
		$query->from($this->tableName);

		$whereClauses = [];

		if(isset($filterByName) && trim($filterByName) != ''){
			array_push($whereClauses, "name LIKE '%" . $filterByName . "%'");
		}

		if(isset($filterByAddress) && trim($filterByAddress) != '') {
			array_push($whereClauses, "address LIKE '%" . $filterByAddress . "%'");
		}

		if(isset($searchTerms) && trim($searchTerms) != ''){
			foreach (preg_split(',', $searchTerms) as $searchTerm){
				array_push($whereClauses, "name LIKE '%" . $searchTerm . "%'");
				array_push($whereClauses, "address LIKE '%" . $searchTerm . "%'");
			}
		}

		if(count($whereClauses)){
			$query->where($whereClauses, 'OR');
		}

		if(isset($this->pagination)){
			$query->setLimit($this->pagination->limit,
				$this->pagination->limitstart);
		}

		return $query;
	}


}