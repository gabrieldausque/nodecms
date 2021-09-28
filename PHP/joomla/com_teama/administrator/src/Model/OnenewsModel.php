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
    if(is_array($data)){
      if(empty($data['author'])){
        $data['author'] = $user->id;
      }
    }
    return $data;
  }

}