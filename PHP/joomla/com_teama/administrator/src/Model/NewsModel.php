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
use Joomla\CMS\MVC\Model\ListModel;

class NewsModel
  extends ListModel
{

  public function __construct($config = [], MVCFactoryInterface $factory = NULL) {
    parent::__construct($config, $factory);
  }

  protected function getListQuery() {
    $db = $this->getDbo();
    $query = $db->getQuery(true);

    $query->select(['*']);
    $query->from($db->quoteName('#__teama_news'));

    return $query;
  }

}