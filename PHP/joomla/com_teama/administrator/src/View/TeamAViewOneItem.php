<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use \Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

abstract class TeamAViewOneItem
	extends BaseHtmlView
{
	protected $form;

	protected $item;

	protected string $newTitle;

	protected string $editTitle;

	protected string $typeName;

	protected $header_fields = [];

	protected $body_fields = [];

	public function __construct(
		$typeName,
		$newTitle,
		$editTile,
		$config = array()) {
		parent::__construct( $config );
		$this->typeName = strtolower($typeName);
		$this->newTitle = $newTitle;
		$this->editTitle = $editTile;
	}

	public function display($tpl = NULL) {
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		$this->addToolBar();

		parent::display($tpl); 
	}

	public function addToolBar(){
		Factory::getApplication()->input->set('hidemainmenu', false);
		$isNew = ($this->item->id == 0);
		ToolbarHelper::title($isNew ?
			Text::_($this->newTitle):
			Text::_($this->editTitle));

		ToolbarHelper::apply($this->typeName . '.apply');
		ToolbarHelper::cancel($this->typeName . '.cancel',
			'JTOOLBAR_CLOSE');
	}

	public function addHeaderField($fieldName){
		if(!in_array($fieldName, $this->header_fields)){
			array_push($this->header_fields, $fieldName);
		}
	}

	public function addBodyField(BodyField $bodyField){
		if(!$this->hasBodyField($bodyField->name)){
			array_push($this->body_fields, $bodyField);
		}
	}

	public function hasBodyField(string $fieldName): bool {
		foreach ($this->body_fields as $existingField){
			if($existingField->name == $fieldName)
				return true;
		}
		return false;
	}
}