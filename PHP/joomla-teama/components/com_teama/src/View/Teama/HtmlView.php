<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\View\Teama;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$this->news = $this->get('News');

		parent::display( $tpl );
	}
}
