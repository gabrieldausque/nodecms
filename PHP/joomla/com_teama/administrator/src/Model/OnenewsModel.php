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

class OnenewsModel
  extends AdminModel
{

  public $typeAlias = 'com_teama.onenews';

  public function getForm($data = [], $loadData = TRUE) {
    $form = $this->loadForm($this->typeAlias,
    'onenews',
    [
      'control' => 'jform',
      'load_data' => $loadData
    ]);

    if(empty($form)){
      return false;
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
		$item = parent::getItem( $pk );
		if($item && property_exists($item, 'header_media'))
		{
			$item->header_media = json_decode($item->header_media,true);
		}
		return $item;
	}

  protected function canDelete($record) {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    return $user->authorise('news.delete','com_teama');
    return false;
  }

}