<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

\defined('_JEXEC') or die('Access Restricted');

class HelprequestsController extends TeamAListController {

  public function __construct($config = [], MVCFactoryInterface $factory = NULL, ?CMSApplication $app = NULL, ?Input $input = NULL) {
    parent::__construct('Helprequests', 'Helprequests', $config, $factory, $app, $input);
  }

}