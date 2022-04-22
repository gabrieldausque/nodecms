<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\Helprequestobjective;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Response\JsonResponse;

class JsonView
	extends BaseJsonView
{
	protected $_output;

	function display( $tpl = null ) {
		echo json_encode($this->_output);
	}
}