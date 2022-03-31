<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class TeamAFrontendView
	extends BaseHtmlView
{

	protected $items;

	protected $pagination;

	protected $actions;

	function display( $tpl = null ) {
		$this->actions = $this->get('Actions');
		$this->pagination = $this->get('Pagination');
		$this->filterForm = $this->get('FilterForm');
		$this->items = $this->get('Items');
		parent::display( $tpl ); 
	}
}