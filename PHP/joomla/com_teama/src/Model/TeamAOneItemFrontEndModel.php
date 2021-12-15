<?php
namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAOneItemModel;
use TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\Actions;

abstract class TeamAOneItemFrontEndModel
	extends TeamAOneItemModel
{
	protected string $typeName;
	protected string $pluralTypeName;

	public function __construct(
		string $typeName,
		string $pluralTypeName,
		$typeAlias,
		$formName,
		$config = array(),
		MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct( $typeAlias,
			$formName,
			$config,
			$factory,
			$formFactory );
		$this->typeName = strtolower($typeName);
		$this->pluralTypeName = strtolower($pluralTypeName);
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