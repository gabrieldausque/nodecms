<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\Component\Contact\Site\Model\CategoryModel;
use Joomla\Component\Users\Administrator\Model\GroupModel;
use TheLoneBlackSheep\Component\TeamA\Administrator\Helpers\UserHelpers;

class OnenewsModel
  extends AdminModel
{

  private $item = null;

  public $typeAlias = 'com_teama.onenews';

  public function getForm($data = [], $loadData = TRUE) {
  	$app = Factory::getApplication();
  	$user = $app->getIdentity();
  	$isRH = UserHelpers::IsUserRH($user);
    $form = $isRH?
	    $this->loadForm($this->typeAlias,'onenews_rh', [ 'control' => 'jform', 'load_data' => $loadData ]):
	    $this->loadForm($this->typeAlias,'onenews', [ 'control' => 'jform', 'load_data' => $loadData ]);

    if(empty($form)){
      return false;
    }

    if($isRH){
    	$form->setFieldAttribute("catid",
		    "default",
		    $this->getRHCategoryId());
    }

    return $form;
  }

  protected function loadFormData() {
    $app = Factory::getApplication();
    $data = $this->getItem();
    $this->preprocessData($this->typeAlias, $data);
    return $data;
  }

  protected function prepareTable($table) {
    $table->generateAlias();
  }

  public function validate($form, $data, $group = NULL) {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    $data = parent::validate($form, $data, $group);
    $item = null;
    if(is_array($data)){

      if($data['id'] > 0){
        $item = $this->getItem($data['id']);
      }

      if(isset($item))
      {
        $data['author'] = $item->author;
        $data['creation_date'] = $item->creation_date;
        $data['publication_date'] = $item->publication_date;
        $data['current_stage'] = $item->current_stage;
        $data['publication_status'] = $item->publication_status;
      }

      if(empty($data['author'])){
        $data['author'] = $user->id;
      }

      $data['last_modifier'] = $user->id;
      $data['modification_date'] = (new \DateTime())->format('Y-m-d H:i:s');
    }
    return $data;
  }

  public function getItem( $pk = null ) {
    $this->item = parent::getItem( $pk );
	if($this->item && property_exists($this->item, 'header_media'))
	{
		$this->item->header_media = json_decode($this->item->header_media,true);
	}
	$var = $this->getTags($this->item->id);
	$this->item->{"tags"} = implode(',',$var);
	return $this->item;
  }

  protected function canDelete($record) {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    return $user->authorise('news.delete','com_teama');
  }

  public function save($data) {
    $saved = parent::save($data);
    $newsId = $this->getState('onenews.id');

    if($saved && isset($data['tags'])){
      //First check if tags already exists, and if not create them
      $tagsModel = new TagsModel();
      $tagsModel->createIfNotExist($data['tags']);
      $expectedTags = [];
      foreach(explode(',',$data['tags']) as $tag){
        $tag = trim($tag);
        if($tag != '')
          array_push($expectedTags, $tag);
      }
      $currentTags = $this->getTags($newsId);
      $tagsToAdd = array_diff($expectedTags, $currentTags);
      $tagsToRemove = array_diff($currentTags, $expectedTags);
      if(count($tagsToAdd) > 0){
        $this->addTags($newsId, $tagsToAdd);
      }
      if(count($tagsToRemove) > 0){
        $this->deleteTags($tagsToRemove);
      }
    }
    return $saved;
  }

  public function addTags($pk = null, $tagsToAdd = []){
    $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
    $tagsToAdd = array_map(function ($elt) {
      return "'" . $elt . "'";
    }, $tagsToAdd);
    if(count($tagsToAdd) > 0){
      $db = $this->getDbo();
      $query =
      "INSERT IGNORE INTO #__teama_news_tags (news_id, tags_id)
      SELECT " . $pk . ",a.id from #__teama_tags a
      WHERE a.tag IN (" . implode(',', $tagsToAdd) . ")" ;
      $db->setQuery($query);
      $db->execute();
    }
  }

  public function deleteTags($tagsToRemove = []){
    $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
    if(count($tagsToRemove) > 0){
      $tagsToRemove = array_map(function ($elt) {
        return "'" . $elt . "'";
      }, $tagsToRemove);
      $db = $this->getDbo();
      $query =
        "DELETE a 
         FROM #__teama_news_tags a
         INNER JOIN #__teama_tags b 
             ON a.tags_id=b.id
             AND a.news_id=" . $pk .
        "    AND b.tag IN (" . implode(',', $tagsToRemove) . ")";
      $db->setQuery($query);
      $db->execute();
    }
  }

  public function getTags(int $pk = null) {
    $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
    $db = $this->getDbo();
    $query =
      "SELECT b.tag FROM #__teama_news_tags a
        INNER JOIN #__teama_tags b ON a.tags_id = b.id AND a.news_id=" . $pk;
    $db->setQuery($query);
    return array_map(function($elt) {
      return $elt->tag;
    }, $db->loadObjectList());
  }

  protected function getRHCategoryId(): int {
  	$db = $this->getDbo();
  	$query = 'SELECT id from #__categories WHERE title = "RH" and extension = "com_teama"';
  	$db->setQuery($query);
  	return $db->loadResult();
  }

  public function IsRHNews($item = null) : bool{
  	if(!isset($item)){
  		$item = $this->item;
    }
  	if(isset($item)){
  		return $item->catid == $this->getRHCategoryId();
    }
  	return false;
  }

}