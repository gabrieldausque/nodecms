<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel;

abstract class TeamAListFrontEndModel
	extends TeamAListModel
{

	protected string $pluralTypeName;

	protected string $typeName;

	public function __construct(
		string $typeName,
		string $pluralTypeName,
		$filterFormName,
		$tableName, $config = array(),
		MVCFactoryInterface $factory = null ) {
		parent::__construct(
			$filterFormName,
			$tableName,
			$config,
			$factory );
		$this->typeName = strtolower($typeName);
		$this->pluralTypeName = strtolower($pluralTypeName);
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
}