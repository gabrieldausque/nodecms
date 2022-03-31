<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

\defined('_JEXEC') or die('Access Restricted');

class HelprequestsModel extends TeamAListModel {

  public function __construct($config = [], MVCFactoryInterface $factory = NULL) {
    parent::__construct('filter_helprequests', '#__teama_help_requests', $config, $factory);
  }

  protected function getListQuery()
  {
	  $dbo = $this->getDbo();

	  $query = $dbo->getQuery(true);
	  $query->select('*');
	  $query->from($this->tableName);
	  $query->order(["id DESC"]);

	  return $query;
  }

  public function getCanSearch()
  {
	  return false;
  }

}