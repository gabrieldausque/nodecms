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

	protected string $typeName = '';
	protected string $pluralTypeName = '';

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

	protected function populateState() {
		$app = Factory::getApplication();
		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState($this->pluralTypeName . '.id', $pk);
		$this->setState($this->pluralTypeName . '.layout', $app->input->get('layout'));
	}


	protected function canDelete($record) {
		$app = Factory::getApplication();
		$user = $app->getIdentity();
		return $user->authorise($this->pluralTypeName . '.delete','com_teama');
	}

	public function getItem($pk = null){
		$app = Factory::getApplication();
		$user = $app->getIdentity();

		$pk = (int) ($pk ?: $this->getState($this->pluralTypeName . '.id'));

		if(!isset($user))
			die("You must be a registered user");

		$item = null;

		if($user->authorise($this->pluralTypeName . '.read','com_teama'))
		{
			$item = parent::getItem($pk);
		} else
			$item = $this->getUnauthorizedEntity();

		if(!isset($item))
			$item = $this->getNewEntity();
		$this->item = $item;
		return $this->item;
	}

	public function getActions(){
		$app = Factory::getApplication();
		$user = $app->getIdentity();
		$id = $this->getState($this->pluralTypeName . '.id');
		$layout = $this->getState($this->pluralTypeName . '.layout');

		$actions = [];
		if($layout != 'edit'){

			if($user->authorise($this->pluralTypeName . '.edit','com_teama') &&
			   isset($id) && $id > 0){

				$editActions = new Actions(
					'edit',
					'index.php?option=com_teama&view=' . $this->typeName . '&layout=edit&id=' . $id
				);
				array_push($actions, $editActions);
			}

			if($user->authorise($this->pluralTypeName . '.delete','com_teama') &&
			   isset($id) && $id > 0){
				$item = $this->getItem($id);
				$deleteAction = new Actions(
					'delete',
					'index.php?option=com_teama&task=' . $this->typeName . '.delete&id=' . $id
				);
				$deleteAction->useConfirmation = true;
				$deleteAction->confirmationMessage = Text::_('COM_TEAMA_DELETE_CONFIRMATION_MESSAGE');
				array_push($actions, $deleteAction);
			}
		}

		return $actions;
	}

	protected abstract function getUnauthorizedEntity();

	protected abstract function getNewEntity();

}