<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class DisplayController
	extends BaseController
{

  protected $default_view = "Teama";

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null,
		?Input $input = null ) {
		parent::__construct( $config, $factory, $app, $input );
	}

	public function display( $cachable = false, $urlparams = array()) {
		$view = $this->getView(strtolower($this->default_view),'html');
		$view->setModel($this->getModel('Teama'), true);
		$view->setModel($this->getModel('News'));
		parent::display( $cachable, $urlparams ); 
		return $this;
	}



}