<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Table;

use Joomla\Database\DatabaseDriver;
use Joomla\Event\DispatcherInterface;

class HelprequestTable extends
	\Joomla\CMS\Table\Table {

	public function __construct( DatabaseDriver $db,
		DispatcherInterface $dispatcher = null ) {
		$this->typeAlias = 'com_teama.helprequest';
		parent::__construct(
			'#__teama_help_requests',
			'id',
			$db,
			$dispatcher );
	}

}