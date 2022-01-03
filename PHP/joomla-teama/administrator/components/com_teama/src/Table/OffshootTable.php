<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Table;

\defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Event\DispatcherInterface;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;

class OffshootTable
	extends Table {

	public function __construct(DatabaseDriver $db) {
		$this->typeAlias = 'com_teama.offshore';
		parent::__construct( '#__teama_offshoots',
			'id',
			$db);
	}
}