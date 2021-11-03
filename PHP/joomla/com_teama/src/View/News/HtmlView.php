<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\News;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView
	extends BaseHtmlView{

  protected $news;

  protected $pagination;

  protected $actions;

	function display( $tpl = null ) {
    $this->actions = $this->get('Actions');
	  $this->pagination = $this->get('Pagination');
	  $this->news = $this->get('News');
		parent::display( $tpl );
	}

}