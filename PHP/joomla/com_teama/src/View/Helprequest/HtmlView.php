<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\View\Helprequest
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\View\Helprequest;

class HtmlView extends \Joomla\CMS\MVC\View\HtmlView
{
	protected $item;

	protected $actions;

	protected $form;

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');
		parent::display($tpl);
	}
}