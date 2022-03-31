<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use FG\ASN1\Exception\NotImplementedException;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Pagination\Pagination;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\Entities\Actions;

abstract class TeamAListModel extends \Joomla\CMS\MVC\Model\ListModel {
	protected Pagination $pagination;

	protected int $paginationLimit = 20;

	protected $filterFormName = '';

	protected string $tableName = '';

	// for frontend
	protected string $pluralTypeName;

	protected string $typeName;

	public function __construct($filterFormName,
		$tableName,
		$config = array(),
		MVCFactoryInterface $factory = null ) {
		$this->populateState();
		$this->filterFormName = $filterFormName;
		$this->tableName = $tableName;
		parent::__construct( $config, $factory );
	}

	protected function populateState($ordering = null, $direction = null) {
		parent::populateState();
		$app = Factory::getApplication();
		$this->setState('start', $app->input->getInt('limitstart', 0));
		$this->setState('limit', $this->paginationLimit);
	}

	public function getPagination() {
		$pageIndex = $this->getState('start');
		$limit = $this->getState('limit');
		$start = $this->getState('start');
		$total     = $this->getTotal();
		$this->cleanCache();
		$this->pagination = new Pagination($total, $start, $limit);
		return $this->pagination;
	}

	protected function _getList($query,
		$limitstart = 0,
		$limit = 0) {
		$db = $this->getDbo();
		$db->setQuery($this->getListQuery());
		return $db->loadObjectList();
	}

	protected function getEmptyStateQuery() {
		return "SELECT * FROM " . $this->tableName . " WHERE 1=0";
	}

	public function delete($pks = []){
		if(is_array($pks) && count($pks) > 0){
			$db = $this->getDbo();
			$query = "DELETE " . $this->tableName . " FROM " . $this->tableName . " WHERE id IN (" . implode(',', $pks) . ")";
			$db->setQuery($query);
			$db->execute();
		}
	}

	public function getActions(){
		$app = Factory::getApplication();
		$user = $app->getIdentity();

		$actions = [];

		if($user->authorise(
			$this->pluralTypeName . '.create',
			'com_teama'))
		{
			array_push($actions, new Actions(
				'create',
				'index.php?option=com_teama&view='. $this->typeName .'&layout=edit'
			));
		}

		return $actions;
	}

	public function getCanSearch(){
		return true;
	}

	protected function getListQuery()
	{
		throw new NotImplementedException("getListQuery is not implemented");
	}

}