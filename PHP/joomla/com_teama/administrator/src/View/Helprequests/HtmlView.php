<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequests;

\defined('_JEXEC') or die;

class HtmlView extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList {

  public function __construct($config = []) {
    parent::__construct('COM_TEAMA_MANAGER_HELP_REQUESTS', 'helprequests', 'helprequest', $config);
  }

  function getItemName($item) {
    return $item->id;
  }

}