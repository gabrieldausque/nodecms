<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_teama
 *
 * @copyright Copyright 2021 Gabriel DAUSQUE - The loneblacksheep
 * @license GNU/GPL https://www.gnu.org/licenses/gpl-3.0.fr.html
 */
namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * @since 0.0.1
 */
class DisplayController
	extends BaseController
{
	protected $default_view = 'Teama';

	public function display( $cachable = false, $urlparams = array() ) {
		return parent::display();
	}
}