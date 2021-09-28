<?php
/**
 * @package     ${NAMESPACE}
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

class OnenewsTable extends Table {

  public function __construct(DatabaseDriver $db) {
    $this->typeAlias = 'com_teama.onenews';
    parent::__construct('#__teama_news','id',$db);
  }

  public function generateAlias() {
    if(empty($this->alias)){
      $this->alias = $this->title;
    }

    $this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

    if(trim(str_replace('-','',$this->alias)) == ''){
      $this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
    }

    return $this->alias;
  }

}