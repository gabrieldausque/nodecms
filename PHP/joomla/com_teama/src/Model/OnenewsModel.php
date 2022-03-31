<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\User\UserHelper;
use TheLoneBlackSheep\Component\TeamA\Administrator\Helpers\UserHelpers;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\Entities\OneNews;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\Entities\Actions;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel as BaseOneNewsModel;

class OnenewsModel
  extends BaseOneNewsModel {

  public function __construct($config = [], MVCFactoryInterface $factory = NULL, FormFactoryInterface $formFactory = NULL) {
    parent::__construct($config, $factory, $formFactory);
  }

  protected $item;

  protected function populateState() {
    $app = Factory::getApplication();

    // Load state from the request.
    $pk = $app->input->getInt('id');
    $this->setState('news.id', $pk);
    $this->setState('news.layout', $app->input->get('layout'));
  }

  private function deserialize($onenews) {
    if(isset($onenews) && property_exists( $onenews, 'header_media'))
      $onenews->header_media = json_decode($onenews->header_media);
  }

  public function getItem($pk = null){
    $app = Factory::getApplication();
    $user = $app->getIdentity();

    $pk = (int) ($pk ?: $this->getState('news.id'));

    if(!isset($user))
      die("You must be a registered user");

    $theNews = null;

    if($user->authorise('news.read','com_teama'))
    {
      $theNews = parent::getItem($pk);
    } else
      $theNews = new OneNews(true);

    if(!isset($theNews))
      $theNews = new OneNews();
    $this->item = $theNews;
    return $this->item;
  }

  public function getActions(){
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    $id = $this->getState('news.id');
    $layout = $this->getState('news.layout');

    $actions = [];
    if($layout != 'edit'){

    	if($user->authorise('news.edit','com_teama') && isset($id) && $id > 0){

    		$editActions = new Actions(
			    'edit',
			    'index.php?option=com_teama&view=onenews&layout=edit&id=' . $id
		    );
    		if(UserHelpers::IsUserRH($user))
		    {
			    if(!isset($this->item))
			    {
				    $this->getItem($id);
			    }
			    if($this->item->catid == $this->getRHCategoryId()){
				    array_push($actions, $editActions);
			    }
		    } else {
			    array_push($actions, $editActions);
		    }
      }

      if($user->authorise('news.delete','com_teama') && isset($id) && $id > 0){
      	$news = $this->getItem($id);
        $deleteAction = new Actions(
          'delete',
          'index.php?option=com_teama&task=onenews.delete&id=' . $id
        );
        $deleteAction->useConfirmation = true;
        $deleteAction->confirmationMessage = Text::_('COM_TEAMA_NEWS_DELETE_CONFIRMATION_MESSAGE') . ' "' . $news->title . '" ?';
	    if(UserHelpers::IsUserRH($user))
	    {
		    if($news->catid == $this->getRHCategoryId()){
			     array_push($actions, $deleteAction);
		    }
	    }
        else {
	        array_push($actions, $deleteAction);
        }
      }
    }

    return $actions;
  }

  public function delete(&$pks) {
    return parent::delete($pks); 
  }

}