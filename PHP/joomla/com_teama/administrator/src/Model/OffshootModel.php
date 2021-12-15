<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\Component\Contact\Site\Model\CategoryModel;
use Joomla\Component\Users\Administrator\Model\GroupModel;
use TheLoneBlackSheep\Component\TeamA\Administrator\Helpers\UserHelpers;


class OffshootModel
	extends TeamAOneItemModel {

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( 'com_teama.offshoot',
			'offshoot', $config, $factory, $formFactory );
	}

}