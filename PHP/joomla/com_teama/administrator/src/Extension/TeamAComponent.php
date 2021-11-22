<?php
namespace TheLoneBlackSheep\Component\TeamA\Administrator\Extension;

use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Helper\ContentHelper;
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

	public function countItems( array $items, string $section ) {
		try {
			$config = (object)[
				'related_tbl' => $this->getTableNameForSection($section),
				'state_col' => 'publication_status',
				'group_col' => 'catid',
				'relation_type' => 'category_or_group'
			];
			ContentHelper::countRelations($items,$config);
		}catch(\Exception $ex){
			//Ignoring
		}
	}

	protected function getTableNameForSection( string $section = null ) {
		return ($section === 'category') ?
			'categories':
			'teama_news';
	}
}