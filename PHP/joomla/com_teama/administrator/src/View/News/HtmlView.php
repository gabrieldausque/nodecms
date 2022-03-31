<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\News;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView
	extends \Joomla\CMS\MVC\View\HtmlView
{
  protected $pagination;

  protected $teamaNews;

  public $filterForm;

	public function display( $tpl = null ) {
    $this->pagination = $this->get('Pagination');
    $this->filterForm = $this->get('FilterForm');
    $this->teamaNews = $this->get('Items');

    if(!count($this->teamaNews) && $this->get('IsEmptyState')) {
      $this->setLayout('emptystate');
    }

    $this->addToolbar();

		parent::display( $tpl ); 
	}

	protected function addToolbar(){
	  $toolbar = Toolbar::getInstance();
	  $app = Factory::getApplication();
	  $user = $app->getIdentity();

	  ToolbarHelper::title(Text::_('COM_TEAMA_MANAGER_NEWS'), 'manage teama');

    if($user->authorise('news.create','com_teama'))
      $toolbar->addNew('onenews.add');

    if($user->authorise('news.delete','com_teama'))
      $toolbar->delete('news.delete');
  }
}