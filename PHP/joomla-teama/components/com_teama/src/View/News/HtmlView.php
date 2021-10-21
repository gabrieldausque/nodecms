<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\News;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView
	extends BaseHtmlView{

  protected $news;

  protected $pagination;

	function display( $tpl = null ) {

	  $this->pagination = $this->get('Pagination');
	  $this->news = $this->get('News');
		parent::display( $tpl );
	}

}