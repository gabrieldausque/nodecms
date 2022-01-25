<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class OffshootsModel
	extends TeamAListFrontEndModel
{
	public function __construct($config = array(), MVCFactoryInterface $factory = null ) {
		parent::__construct(
			'offshoot',
			'offshoots',
			'filter_offshoots',
			'#__teama_news', $config, $factory );
	}
}