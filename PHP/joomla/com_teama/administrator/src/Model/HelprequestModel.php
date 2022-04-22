<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Model;

use DateTime;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

\defined('_JEXEC') or die;

class HelprequestModel
	extends TeamAOneItemModel {

	private $objectiveModel;

	public function __construct( $config = array(), MVCFactoryInterface $factory = null, FormFactoryInterface $formFactory = null ) {
		parent::__construct(
			'com_teama.helprequest',
			'helprequest',
			$config, $factory, $formFactory );
		$this->pluralTypeName = 'helprequests';
		$this->typeName = 'helprequest';
		$this->objectiveModel = new HelprequestobjectiveModel($config,$factory, $formFactory);
	}

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);
		$item->setProperties(['objectives' => $this->getObjectives($item->id)]);
        return $item;
    }

	public function getObjectives($helpRequestId){
		if($helpRequestId > 0){
			$db = $this->getDbo();
			$query = 'SELECT o.* FROM #__teama_help_requests_objectives o 
 INNER JOIN #__teama_objectives_by_help_requests obhr ON obhr.objective_id = o.id AND obhr.request_id=' . $helpRequestId;
			$db->setQuery($query);
			$results = $db->loadObjectList();
			return $results;
		}
		return [];
	}

    protected function getUnauthorizedEntity() {
		return [
			'id' => 0,
			'creation_date' => new DateTime(),
			'requester_service' => 'The ring fellowship',
			'requester' => 'Angmar',
			'content' => Text::_('COM_TEAMA_YOU_SHALL_NOT_PASS'),
			'request_datetime' => new DateTime(),
			'address' => 'The moria mine',
			'difficulties' => 'Titan',
			'request_type' => 0
		];
	}

	protected function getNewEntity() {
		return [
			'id' => 0,
			'creation_date' => new DateTime(),
			'requester_service' => '',
			'requester' => '',
			'content' => '',
			'request_datetime' => new DateTime(),
			'address' => '',
			'difficulties' => '',
			'request_type' => 0
		];
	}

	function save($data)
	{
		//TODO : save objective links
		$justSaved = parent::save($data);
		$id = $this->getState('helprequest.id');
		$updatedOrCreated = $this->getItem();
		$this->saveLinkedObjectives($updatedOrCreated, $data);
		return $justSaved; // TODO: Change the autogenerated stub
	}

	protected function saveLinkedObjectives($helpRequest,$data){
		$updatedObjectiveIds = $data['objectives'];
		$existingIds = [];
		foreach($helpRequest->objectives as $objective){
			$existingIds[] = $objective->id;
		}
		$toDelete = [];
		$toAdd = [];
		foreach($helpRequest->objectives as $existing){
			if(!in_array($existing->id,$updatedObjectiveIds)){
				$toDelete[] = $existing->id;
			}
		}
		foreach ($updatedObjectiveIds as $inModificationId){
			if(!in_array($inModificationId, $existingIds)){
				$toAdd[] = $inModificationId;
			}
		}

	}

	public function getObjectiveForm(){
		$this->objectiveModel->item = null;
		return $this->objectiveModel->getForm([],false);
	}
}