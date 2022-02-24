<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\News;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use TheLoneBlackSheep\Component\TeamA\Site\Model\OnenewsModel;

class HtmlView
	extends BaseHtmlView{

  protected $news;

  protected $pagination;

  protected $actions;

	function display( $tpl = null ) {
    $this->actions = $this->get('Actions');
	  $this->pagination = $this->get('Pagination');
	  $this->filterForm = $this->get('FilterForm');
	  $this->news = $this->get('News');
		parent::display( $tpl );
	}

	public function isRHNews($theNews):bool {
		$model = new OnenewsModel();
		return $model->IsRHNews($theNews);
	}
}