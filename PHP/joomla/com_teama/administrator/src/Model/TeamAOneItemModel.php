<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use TheLoneBlackSheep\Component\TeamA\Administrator\Helpers\UserHelpers;

abstract class TeamAOneItemModel extends AdminModel {

	protected $item = null;

	public $typeAlias = '';

	protected $formName = '';

	public function __construct($typeAlias,
		$formName,
		$config = array(),
		MVCFactoryInterface $factory = null,
		FormFactoryInterface $formFactory = null ) {
		parent::__construct( $config, $factory, $formFactory );
		$this->typeAlias = $typeAlias;
		$this->formName = $formName;
	}

	public function getForm( $data = array(), $loadData = true ) {
		$form = $this->loadForm($this->typeAlias,$this->formName, [ 'control' => 'jform', 'load_data' => $loadData ]);
		if(empty($form))
			return false;
		return $form;
	}

	protected function loadFormData() {
		$data = $this->getItem();
		$this->preprocessData($this->typeAlias, $data);
		return $data;
	}
}