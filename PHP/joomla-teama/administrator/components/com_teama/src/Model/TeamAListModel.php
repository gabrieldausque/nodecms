<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Pagination\Pagination;

abstract class TeamAListModel extends \Joomla\CMS\MVC\Model\ListModel {
	protected Pagination $pagination;

	protected int $paginationLimit = 20;

	public function __construct( $config = array(), MVCFactoryInterface $factory = null ) {
		$this->populateState();
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


}