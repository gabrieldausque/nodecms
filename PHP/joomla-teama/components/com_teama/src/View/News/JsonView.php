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

    $this->pagination = $this->get('Pagination');
	  $this->_output = new class(){
		  public $news = [];
		  public $next = null;
    };


		$this->_output->news = $this->get('News');
		$paginationPages = $this->get('Pagination')->getPaginationPages();
		if(array_key_exists('next', $paginationPages)){
			$next = $paginationPages['next']['data'];
			$this->_output->next = ($next->base == null)?
				null:
				$next;
		}
		echo json_encode($this->_output);
	}
}