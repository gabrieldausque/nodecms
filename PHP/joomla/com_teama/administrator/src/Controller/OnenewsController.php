<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

class OnenewsController
  extends FormController
{
  protected $view_list = "news";

  public function display($cachable = FALSE, $urlparams = []) {
    return parent::display($cachable, $urlparams);
  }

}