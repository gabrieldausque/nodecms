<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use \Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView
  extends BaseHtmlView
{
  protected $form;

  protected $theNews;

  public function display($tpl = NULL) {
    $this->form = $this->get('Form');
    $this->theNews = $this->get('Item');

    $this->addToolBar();

    parent::display($tpl); 
  }

  public function addToolBar(){
    Factory::getApplication()->input->set('hidemainmenu', false);
    $isNew = ($this->theNews->id == 0);
    ToolbarHelper::title($isNew ?
    Text::_('COM_TEAMA_MANAGER_ONENEWS_NEW'):
    Text::_('COM_TEAMA_MANAGER_ONENEWS_EDIT'), 'manage news');

    ToolbarHelper::apply('onenews.apply');
    ToolbarHelper::cancel('onenews.cancel', 'JTOOLBAR_CLOSE');
  }

  public function getIsRHNews(){
    $model = $this->getModel();
    return $model->isRHNews();
  }

}

