<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class OnenewsController
  extends FormController {

  protected $default_view = "Onenews";

  protected $view_list = "News";

  public function display( $cachable = false, $urlparams = array() ) {
    return parent::display( $cachable, $urlparams );
  }

  public function allowEdit($data = [], $key = 'id') {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    if(isset($user)){
      return $user->authorise('news.edit','com_teama');
    }
    return false;
  }

  public function allowAdd($data = []) {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    if(isset($user)){
      return $user->authorise('news.create','com_teama');
    }
    return false;
  }

  public function save($key = NULL, $urlVar = NULL) {
    return parent::save($key, $urlVar); 
  }

  public function delete(){
    $model = $this->getModel();
    $url = 'index.php?option=' . $this->option . '&view=' . $this->view_list
           . $this->getRedirectToListAppend();
    $app = Factory::getApplication();
    $input = $app->getInput();
    $id = $input->getInt('id');
    if(isset($id)){
      $ids = [
        $id
      ];
      if($model->delete($ids)){
        $app->enqueueMessage(Text::_('COM_TEAMA_DELETE_OK_MESSAGE'), $app::MSG_NOTICE);
      } else {
        $url = 'index.php?option=' . $this->option . '&view=' . $this->default_view
               . '&task=onenews.display&id=' . $id;
      }
      $this->setRedirect(Route::_($url, false));
    }
  }

}