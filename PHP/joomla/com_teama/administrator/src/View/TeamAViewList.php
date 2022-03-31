<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\View;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;



abstract class TeamAViewList
	extends \Joomla\CMS\MVC\View\HtmlView
{

	protected $pagination;

	protected $items = [];

	public $filterForm;

	protected string $title;

	protected string $item_type;

	protected string $item_single_name;

	protected $fields_to_display = [];

	public function __construct(string $title,
		string $item_type,
		string $item_single_name,
		$config = array() ) {
		parent::__construct( $config );
		$this->title = $title;
		$this->item_type = strtolower($item_type);
		$this->item_single_name = strtolower($item_single_name);
	}

	public function display( $tpl = null ) {
		$this->pagination = $this->get('Pagination');
		$this->filterForm = $this->get('FilterForm');
		$this->items = $this->get('Items');

		if((!isset($this->items) ||
		   (is_array($this->items) && !count($this->items)) ||
		   !$this->items) &&
		   $this->get('IsEmptyState')
		) {
			$this->setLayout('emptystate');
		}

		$this->addToolbar();

		parent::display( $tpl ); 
	}

	protected function addToolbar(){
		$toolbar = Toolbar::getInstance();
		$app = Factory::getApplication();
		$user = $app->getIdentity();

		ToolbarHelper::title(Text::_($this->title));

		if($user->authorise($this->item_type . '.create','com_teama'))
			$toolbar->addNew($this->item_single_name . '.add');

		if($user->authorise($this->item_type . '.delete','com_teama'))
			$toolbar->delete($this->item_type . '.delete');
	}

	abstract function getItemName($item);

	public function addFieldToDisplay(HeaderField $fieldName){
		if(!in_array($fieldName, $this->fields_to_display)){
			array_push($this->fields_to_display, $fieldName);
		}
	}
}