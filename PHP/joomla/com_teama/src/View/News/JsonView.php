<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\News;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Response\JsonResponse;

class JsonView
	extends BaseJsonView
{
	protected $_output;

	function display( $tpl = null ) {
		$this->_output = $this->get('News');
		echo json_encode($this->_output);
	}
}