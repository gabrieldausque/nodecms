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

class NewsModel
  extends TeamAListModel
{

 public function __construct($config = [], MVCFactoryInterface $factory = NULL) {
    if(empty($config['filter_fields'])){
      $config['filter_fields'] = [
        'tags','a.tags',
        'title','a.title'
      ];
    }
    $this->paginationLimit = 8;
    parent::__construct($config, $factory);
  }

  protected $filterFormName = 'filter_news';

  protected function getListQuery() {
    $filterByTags = is_array($this->getState('filter.tag'))?
      $this->getState('filter.tag'):
      null;
    $filterByTitle = $this->getState('filter.title');
    $db = $this->getDbo();
    $query =
    "SELECT a.*, cat.title as category_title, COALESCE(GROUP_CONCAT(c.tag SEPARATOR ','),'') as tags
     FROM #__teama_news a";

    if(!isset($filterByTags)){
      $query .= "
        LEFT OUTER JOIN #__teama_news_tags b ON a.id = b.news_id
        LEFT OUTER JOIN #__teama_tags c ON c.id = b.tags_id ";
    } else {
      $query .= "
        INNER JOIN #__teama_news_tags b ON a.id = b.news_id
        INNER JOIN #__teama_tags c ON c.id = b.tags_id AND c.id IN (" . implode(',',$filterByTags) . ") 
      ";
    }

    $query .= "
    INNER JOIN #__categories cat on a.catid = cat.id 
    ";

    $whereClause = [];

    if(isset($filterByTitle) && trim($filterByTitle) != ''){
      $whereClause["title"] = [$filterByTitle];
    }

    $searchTerms = $this->getState('filter.search');

    if(isset($searchTerms) && trim($searchTerms) != ''){

      if(array_key_exists("title",$whereClause) && is_array($whereClause["title"])){
        array_push($whereClause["title"],$searchTerms);
      } else {
        $whereClause["title"] = [$searchTerms];
      }

      if(array_key_exists("summary",$whereClause) && is_array($whereClause["summary"])){
        array_push($whereClause["summary"],$searchTerms);
      } else {
        $whereClause["summary"] = [$searchTerms];
      }

    }

    if(count($whereClause) > 0){
      $query .= "WHERE ";
      foreach($whereClause as $fieldName => $values){
        foreach ($values as $index => $value){
          $query .= " " . $fieldName . " LIKE '%" . $value . "%' ";
          if(!($index == array_key_last($values))){
            $query .= " OR ";
          }
        }
        if(!($fieldName == array_key_last($whereClause))){
          $query .= " OR ";
        }
      }
    }

    $query .= " GROUP BY a.id
    ";
    $query .= " ORDER BY a.modification_date DESC
    ";
    if(isset($this->pagination))
      $query .= " LIMIT " . $this->pagination->limit . " OFFSET " . $this->pagination->limitstart;
    return $query;
  }

  protected function getEmptyStateQuery() {
    return "SELECT *, '' as tags FROM #__teama_news WHERE 1=0";
  }

  public function delete($pks = []){
    if(is_array($pks) && count($pks) > 0){
      $db = $this->getDbo();
      $query = "DELETE #__teama_news FROM #__teama_news WHERE id IN (" . implode(',', $pks) . ")";
      $db->setQuery($query);
      $db->execute();
    }
  }

  public function deserialize($onenews) {
    if(isset($onenews) && property_exists($onenews, 'header_media'))
      $onenews->header_media = json_decode($onenews->header_media);
  }

}