<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View\Helprequeststypes;

use TheLoneBlackSheep\Component\TeamA\Administrator\View\HeaderField;

class HtmlView extends \TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList
{
    public function __construct($config = array())
    {
        parent::__construct(
            "COM_TEAMA_MANAGER_HELP_REQUEST_TYPES",
            "helprequeststypes",
            "helprequeststype", $config);
		$this->addFieldToDisplay(new HeaderField('name', 'COM_TEAMA_TABLE_HEAD_NAME'));
    }

    function getItemName($item)
    {
        return $item->name;
    }
}