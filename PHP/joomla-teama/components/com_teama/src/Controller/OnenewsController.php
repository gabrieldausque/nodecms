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

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\FormController;

class OnenewsController
  extends FormController {

  protected $default_view = "Onenews";

  public function display( $cachable = false, $urlparams = array() ) {
    return parent::display( $cachable, $urlparams );
  }

  public function allowEdit($data = [], $key = 'id') {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    if(isset($user)){
      return $user->authorise('news.edit');
    }
    return false;
  }

  public function allowAdd($data = []) {
    $app = Factory::getApplication();
    $user = $app->getIdentity();
    if(isset($user)){
      return $user->authorise('news.create');
    }
    return false;
  }


}