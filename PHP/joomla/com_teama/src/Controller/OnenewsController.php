<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class OnenewsController
  extends BaseController {

  protected $default_view = "Onenews";

  public function display( $cachable = false, $urlparams = array() ) {
    return parent::display( $cachable, $urlparams );
  }
  
}