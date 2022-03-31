<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\MVC\Model\ListModel;

class TagsModel
  extends ListModel
{
  public function __construct($config = [], MVCFactoryInterface $factory = NULL) {

    parent::__construct($config, $factory);
  }

  protected function getListQuery() {
    return parent::getListQuery();
  }

  public function createIfNotExist(string $tagsAsCommaSeparatedStrings) {
    $tags = explode(',',$tagsAsCommaSeparatedStrings);
    $db = $this->getDbo();
    $query =
    "INSERT IGNORE INTO 
       #__teama_tags(tag)
    VALUES 
    ";
    $hasOne = false;
    foreach($tags as $index=>$tag){
      $tagTrimmed = trim($tag);
      if($tagTrimmed != ''){
        $hasOne = true;
        $query .= '(\'' . $tagTrimmed . '\')';
        if($index != array_key_last($tags)){
          $query .= ',';
        }
      }
    }
    if($hasOne)
      $db->setQuery($query)->execute();
  }

}