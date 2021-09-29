<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\View\Teama;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
	protected $news;

	public function __construct( $config = array() ) {
		parent::__construct( $config );
	}

	public function display($tpl = null)
	{
		$this->news = $this->get('News', 'News');

		parent::display( $tpl );
	}
}
