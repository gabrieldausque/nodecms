<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Table
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Table;

\defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Event\DispatcherInterface;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;

class TagsTable
  extends Table
{
  public function __construct(DatabaseDriver $db) {
    $this->typeAlias = 'com_teama.tags';
    parent::__construct('#__teama_tags','id',$db);
  }


}