<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequests;

use TheLoneBlackSheep\Component\TeamA\Administrator\View\HeaderField;

\defined('_JEXEC') or die;

class HtmlView extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList {

  public function __construct($config = []) {
    parent::__construct('COM_TEAMA_MANAGER_HELP_REQUESTS',
        'helprequests',
        'helprequest', $config);
	$this->addFieldToDisplay(new HeaderField('request_datetime', "COM_TEAMA_TABLE_HEAD_HELP_REQUEST_REQUEST_DATETIME"));
	$this->addFieldToDisplay(new HeaderField('requester_service', "COM_TEAMA_TABLE_HEAD_SERVICE"));
	$this->addFieldToDisplay(new HeaderField('requester', "COM_TEAMA_TABLE_HEAD_HELP_REQUEST_REQUESTER"));
	$this->addFieldToDisplay(new HeaderField('address', "COM_TEAMA_TABLE_HEAD_ADDRESS"));
	$this->addFieldToDisplay(new HeaderField('request_type',"COM_TEAMA_TABLE_HEAD_HELP_REQUEST_REQUEST_TYPE"));
	$this->addFieldToDisplay(new HeaderField('creation_date', "COM_TEAMA_TABLE_HEAD_CREATION_DATE"));
  }

  function getItemName($item) {
    return $item->id;
  }

}