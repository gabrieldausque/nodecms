<?php
/**
 * @copyright 2021 Gabriel DAUSQUE
 * @license GNU/GPL https://www.gnu.org/licenses/gpl-3.0.fr.html
 */
\defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Installer;
use Joomla\CMS\MVC\Factory\MVCFactory;
use Joomla\CMS\Access;
use Joomla\CMS\Table\Table;
use \Joomla\Component\Config\Administrator\Model\ComponentModel;
use \Joomla\Component\Users\Administrator\Model\GroupModel;
use \Joomla\Component\Categories\Administrator\Model\CategoryModel;
use \Joomla\Component\Categories\Administrator\Model\CategoriesModel;
use TheLoneBlackSheep\Component\TeamA\Site\Model\OnenewsModel;

/**
 * @since 0.0.1
 */
class Com_TeamAInstallerScript
{
	private $minimumJoomlaVersion = '4.0';

	private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;

	public function install($parent) : bool
	{
	  if(!$this->createTeamAGroups())
	    return false;

	  $this->createTeamACategories();

	  $this->setRules();

	  $this->updateViewLevels();

	  $this->updateModulesMinimumAccess();

	  return true;
	}

	public function uninstall($parent) : bool
	{
		return true;
	}

	public function update($parent) : bool
	{
		if(!$this->createTeamAGroups()){
			return false;
		}

		$this->createTeamACategories();

		$this->updateCategories();

		$this->setRules();

		$this->updateViewLevels();

		$this->updateModulesMinimumAccess();

		return true;
	}

	public function preflight($type, $parent) : bool
	{
		if ($type !== 'uninstall') {
			if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<'))
			{
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion),
					Log::WARNING,
					'jerror'
				);

				return false;
			}

			if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<'))
			{
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion),
					Log::WARNING,
					'jerror'
				);

				return false;
			}
		}

		return true;
	}

	public function postflight($type, $parent) : bool
	{
		return true;
	}

	public function foundGroupByName(string $groupName) {
    $groupsModel = new \Joomla\Component\Users\Administrator\Model\GroupsModel();
    $db = $groupsModel->getDbo();
    $db->setQuery("SELECT * from #__usergroups WHERE title='" . $groupName . "'");

    $group = $db->loadObject();

    if(isset($group))
      return $group;

    return false;
  }

	public function getRegisteredGroup() {
	  $registered = false;
    foreach(['Enregistré','Registered'] as $possibleRegisteredTitle){
      $registered = $this->foundGroupByName($possibleRegisteredTitle);
      if ($registered){
        break;
      }
    }
    if(!$registered){
      $groupModel = new \Joomla\Component\Users\Administrator\Model\GroupModel();
      $registered = $groupModel->getItem(2);
    }
    return $registered;
  }

    public function createTeamAGroups() : bool {
    $groupsToBeCreated = [
      'TeamA_Members',
      'TeamA_Clients',
    ];
    $registered = $this->getRegisteredGroup();
    if(!$registered){
      Log::add('"Registered" group was not found. Check name is French or English and that group with id 2 is for registered group',
        Log::ERROR,
        'jerror'
      );
      return false;
    }

    $groupModel = new \Joomla\Component\Users\Administrator\Model\GroupModel();
    foreach($groupsToBeCreated as $teamAGroupName){
      $existing = $this->foundGroupByName($teamAGroupName);
      if(!$existing){
        $groupModel->save([
          'id'=>0,
          'parent_id'=>$registered->id,
          'title'=> $teamAGroupName
        ]);
      }
    }

    $teamAMembers = $this->foundGroupByName('TeamA_Members');
    if (!$this->foundGroupByName('TeamA_Administrators')) {
      $groupModel->save([
        'id'        => 0,
        'parent_id' => $teamAMembers->id,
        'title'     => 'TeamA_Administrators'
      ]);
    }

	if(!$this->foundGroupByName('TeamA_HumanResources')) {
	   $groupModel->save([
	        'id'        => 0,
		    'parent_id' => $teamAMembers->id,
		    'title'     => 'TeamA_HumanResources'
	   ]);
	}

    $this->setRules();

    return true;
  }

    public function setRules(): void {
    $teamAMembers = $this->foundGroupByName('TeamA_Members');
    $teamaAdminGroup = $this->foundGroupByName('TeamA_Administrators');
    $teamaRHGroup = $this->foundGroupByName('TeamA_HumanResources');
    $publicGroup = $this->foundGroupByName('Public');
	$guestGroup = $this->foundGroupByName('Guest');

    $asset           = Table::getInstance('asset');
    $asset->loadByName('com_teama');
    $rules = [
      'core.manage' => [
      	$teamaAdminGroup->id => 1,
	    $teamaRHGroup->id =>1
      ],
      'core.create' => [
      	$teamaAdminGroup->id => 1,
	    $teamaRHGroup->id =>1
      ],
      'core.edit' => [
      	$teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1
      ],
      'core.edit.state' => [
      	$teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1
      ],
      'news.create' => [
      	$teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1
      ],
      'news.edit'   => [
      	$teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1
      ],
      'news.delete' => [
      	$teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1
      ],
      'news.read'   => [
        $teamaAdminGroup->id => 1,
        $teamaRHGroup->id =>1,
      	$teamAMembers->id => 1
      ],
      'offshoots.create' => [
	      $teamaAdminGroup->id => 1,
	      $teamaRHGroup->id =>1
      ],
      'offshoots.edit'   => [
	      $teamaAdminGroup->id => 1,
	      $teamaRHGroup->id =>1
      ],
      'offshoots.delete' => [
	      $teamaAdminGroup->id => 1,
	      $teamaRHGroup->id =>1
      ],
      'offshoots.read'   => [
          $teamaAdminGroup->id => 1,
          $teamaRHGroup->id =>1,
          $teamAMembers->id => 1
      ],
        'helprequeststypes.create' => [
            $teamaAdminGroup->id => 1,
            $teamaRHGroup->id =>1,
	        $guestGroup->id => 1
        ],
        'helprequeststypes.edit'   => [
            $teamaAdminGroup->id => 1,
            $teamaRHGroup->id =>1
        ],
        'helprequeststypes.delete' => [
            $teamaAdminGroup->id => 1,
            $teamaRHGroup->id =>1
        ],
        'helprequeststypes.read'   => [
            $teamAMembers->id => 1,
            $teamaAdminGroup->id => 1,
            $teamaRHGroup->id =>1,
            $guestGroup->id => 1
        ],
        'helprequests.create' => [
            $teamaAdminGroup->id => 1,
            $teamAMembers->id =>1,
	        $guestGroup->id => 1
        ],
        'helprequests.edit'   => [
            $teamaAdminGroup->id => 1
        ],
        'helprequests.delete' => [
            $teamaAdminGroup->id => 1
        ],
        'helprequests.read'   => [
            $teamAMembers->id => 1,
            $teamaAdminGroup->id => 1,
            $teamaRHGroup->id =>1,
            $guestGroup->id => 1
        ]
    ];

    $teamA_asset = [
      'rules' => json_encode($rules),
      'name'  => 'com_teama',
      'title' => 'Team-A'
    ];
    $id = $asset->getId();
    if(isset($id) && $id > 0){
      $teamA_asset = $asset->getProperties();
      $rules = json_decode($teamA_asset['rules'], true);
    }

    $rules['core.manage'][$teamaAdminGroup->id] = 1;
    $rules['core.manage'][$teamaRHGroup->id] = 1;
    $rules['core.create'][$teamaAdminGroup->id] = 1;
    $rules['core.create'][$teamaRHGroup->id] = 1;
    $rules['core.edit'][$teamaAdminGroup->id] = 1;
    $rules['core.edit'][$teamaRHGroup->id] = 1;
    $rules['core.edit.state'][$teamaAdminGroup->id] = 1;
    $rules['core.edit.state'][$teamaRHGroup->id] = 1;
    $rules['news.create'][$teamaAdminGroup->id] = 1;
    $rules['news.create'][$teamaRHGroup->id] = 1;
    $rules['news.edit'][$teamaAdminGroup->id] = 1;
    $rules['news.edit'][$teamaRHGroup->id] = 1;
    $rules['news.delete'][$teamaAdminGroup->id] = 1;
    $rules['news.delete'][$teamaRHGroup->id] = 1;
    $rules['news.read'][$teamAMembers->id] = 1;
    $rules['news.read'][$teamaAdminGroup->id] = 1;
    $rules['news.read'][$teamaRHGroup->id] = 1;
    $rules['offshoots.create'][$teamaAdminGroup->id] = 1;
    $rules['offshoots.create'][$teamaRHGroup->id] = 1;
    $rules['offshoots.edit'][$teamaAdminGroup->id] = 1;
    $rules['offshoots.edit'][$teamaRHGroup->id] = 1;
    $rules['offshoots.read'][$teamaAdminGroup->id] = 1;
    $rules['offshoots.read'][$teamaRHGroup->id] = 1;
    $rules['offshoots.read'][$teamAMembers->id] = 1;
    $rules['offshoots.delete'][$teamaAdminGroup->id] = 1;
    $rules['offshoots.delete'][$teamaRHGroup->id] = 1;
    $rules['helprequeststypes.create'][$teamaAdminGroup->id] = 1;
    $rules['helprequeststypes.create'][$guestGroup->id] = 1;
    $rules['helprequeststypes.edit'][$teamaAdminGroup->id] = 1;
    $rules['helprequeststypes.read'][$teamaAdminGroup->id] = 1;
    $rules['helprequeststypes.read'][$teamAMembers->id] = 1;
    $rules['helprequeststypes.read'][$guestGroup->id] = 1;
    $rules['helprequeststypes.delete'][$teamaAdminGroup->id] = 1;
    $rules['helprequeststypes.delete'][$teamaRHGroup->id] = 1;
    $rules['helprequests.create'][$teamaAdminGroup->id] = 1;
    $rules['helprequests.create'][$teamAMembers->id] = 1;
    $rules['helprequests.create'][$guestGroup->id] = 1;
    $rules['helprequests.edit'][$teamaAdminGroup->id] = 1;
    $rules['helprequests.read'][$teamaAdminGroup->id] = 1;
    $rules['helprequests.read'][$teamAMembers->id] = 1;
    $rules['helprequests.read'][$guestGroup->id] = 1;
    $rules['helprequests.delete'][$teamaAdminGroup->id] = 1;
    $teamA_asset['rules'] = json_encode($rules);

    $asset->save($teamA_asset);

    $asset->loadByName('com_media');
    $media_asset = $asset->getProperties();
      $rules = json_decode($media_asset['rules'], true);
      $rules['core.create'][$teamaAdminGroup->id] = 1;
      $rules['core.create'][$teamaRHGroup->id] = 1;
      $rules['core.create'][$guestGroup->id] = 1;
      $rules['core.edit'][$teamaAdminGroup->id] = 1;
      $rules['core.edit'][$teamaRHGroup->id] = 1;
      $rules['core.edit.state'][$teamaAdminGroup->id] = 1;
      $rules['core.edit.state'][$teamaRHGroup->id] = 1;
      $rules['core.delete'][$teamaAdminGroup->id] = 1;
      $rules['core.delete'][$teamaRHGroup->id] = 1;
      $rules['core.manage'][$teamaAdminGroup->id] = 1;
      $rules['core.manage'][$teamaRHGroup->id] = 1;
      $rules['core.manage'][$guestGroup->id] = 1;

    $media_asset['rules'] = json_encode($rules);
	  $asset->save($media_asset);
  }

    public function createTeamACategories(){
	$categories = [
		[
			'title'=>'Non Catégorisé',
			'path'=>'non-categorise'
		],
		[
			'title'=>'RH',
			'path'=>'teama-human-resource'
		]
	];

	foreach($categories as $category){
		$this->createCategory($category);
	}
  }

  public function createCategory($category)
  {
	$categoryModel = new CategoryModel();
	$categoriesModel = new CategoriesModel();
	$db = $categoriesModel->getDbo();
	$query = $db->getQuery(true);
	$query->select('id,title,path')
	        ->from('#__categories')
	        ->where("title='" . $category['title'] . "'")
	        ->where("extension='com_teama'");
	$db->setQuery($query);
	$existing = $db->loadObject();
	if(!isset($existing)){
	  $category_data['id'] = 0;
	  $category_data['parent_id'] = 0;
	  $category_data['title'] = $category['title'];
	  $category_data['alias'] = $category['path'];
	  $category_data['extension'] = 'com_teama';
	  $category_data['published'] = 1;
	  $category_data['language'] = '*';
	  $category_data['params'] = array('category_layout' => '','image' => '');
	  $category_data['metadata'] = array('author' => '','robots' => '');
	  $category_data['access'] = 2;
	  $categoryModel->save($category_data);
	}
  }

  public function updateCategories() {
	  $db = Factory::getContainer()->get('DatabaseDriver');
	  $query = "
	UPDATE #__teama_news
	SET catid = (SELECT id FROM #__categories WHERE extension = 'com_teama' AND title = 'Non Catégorisé') 
	WHERE catid = 0 OR catid NOT IN (SELECT id FROM #__categories WHERE extension = 'com_teama');
";
	  $db->setQuery($query);
	  $db->execute();
  }

  public function updateViewLevels() {
	  $teamaAdminGroup = $this->foundGroupByName('TeamA_Administrators');
	  $teamaRHGroup = $this->foundGroupByName('TeamA_HumanResources');
	  $db = Factory::getContainer()->get('DatabaseDriver');
      $query = "SELECT * from #__viewlevels WHERE title like 'Super%' ";
      $db->setQuery($query);
      $superUserAccessLevel =  $db->loadObject();
      $rules = json_decode($superUserAccessLevel->rules);
      $rulesModified = false;
      if(!in_array($teamaAdminGroup->id, $rules)){
      	array_push($rules, $teamaAdminGroup->id);
      	$rulesModified = true;
      }
      if(!in_array($teamaRHGroup->id, $rules)){
      	array_push($rules, $teamaRHGroup->id);
      	$rulesModified = true;
      }
      if($rulesModified){
      	$rulesAsString = json_encode($rules);
      	$updateQuery = "UPDATE #__viewlevels SET rules='" . $rulesAsString . "' WHERE id=" . $superUserAccessLevel->id;
      	$db->setQuery($updateQuery);
      	$db->execute();
      }
  }

  public function updateModulesMinimumAccess() {
	  $db = Factory::getContainer()->get('DatabaseDriver');
	  $query = "SELECT * from #__viewlevels WHERE title like 'Super%' ";
	  $db->setQuery($query);
	  $superUserAccessLevel =  $db->loadObject();
	  $query = "UPDATE #__modules SET access=". $superUserAccessLevel->id . " WHERE module='mod_toolbar' and position='toolbar'";
	  $db->setQuery($query);
	  $db->execute();
  }
}
