<?php
namespace TheLoneBlackSheep\Component\TeamA\Administrator\Extension;

use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;

use Psr\Container\ContainerInterface;
use TheLoneBlackSheep\Component\TeamA\Administrator\Service\HTML\AdministratorService;

defined('JPATH_PLATFORM') or die;

class TeamAComponent extends MVCComponent implements BootableExtensionInterface, CategoryServiceInterface {

	use CategoryServiceTrait;
	use HTMLRegistryAwareTrait;

	public function boot( ContainerInterface $container ) {
		$this->getRegistry()->register('team_a_administrator', new AdministratorService);
	}
}