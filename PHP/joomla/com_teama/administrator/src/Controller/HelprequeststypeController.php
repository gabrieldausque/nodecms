<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Controller;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class HelprequeststypeController extends TeamAOneItemController
{
    public function __construct($config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null)
    {
        parent::__construct("Helprequeststypes", $config, $factory, $app, $input, $formFactory);
    }
}