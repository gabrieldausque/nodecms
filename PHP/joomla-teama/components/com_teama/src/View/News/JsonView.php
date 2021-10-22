<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\News;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Response\JsonResponse;

class JsonView
	extends BaseJsonView
{
	protected $_output;

	function display( $tpl = null ) {
		$this->_output = new class(){
		  public $news;
		  public $next;
    };

		$this->_output->news = $this->get('News');

		$next = $this->get('Pagination')->getPaginationPages()['next']['data'];

		$this->_output->next = ($next->base == null)?
      null:
      $next;

		echo json_encode($this->_output);
	}
}