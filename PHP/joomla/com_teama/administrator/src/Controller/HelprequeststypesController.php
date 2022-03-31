<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class HelprequeststypesController extends TeamAListController
{
    public function __construct($config = array(),
                                MVCFactoryInterface $factory = null,
                                ?CMSApplication $app = null,
                                ?Input $input = null)
    {
        parent::__construct("Helprequeststypes",
            "Helprequeststypes",
            $config, $factory, $app, $input);
    }
}