<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamA;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView
	extends BaseHtmlView
{
	public function display( $tpl = null )
	{
    $toolbar = Toolbar::getInstance();
    ToolbarHelper::title(Text::_('COM_TEAMA_MANAGER_COMPONENT'), 'manage teama');
    $toolbar->preferences('com_teama');
	}
}