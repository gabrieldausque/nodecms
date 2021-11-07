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
	  return true;
	}

	public function uninstall($parent) : bool
	{
	  //TODO : remove existing groups !

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

    $this->setRules();

    return true;
  }

	public function update($parent) : bool
	{
	  if(!$this->createTeamAGroups()){
	    return false;
    }

	  $this->setRules();

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

  /**
   *
   *
   * @since version
   */
  public function setRules(): void {
    $teamAMembers = $this->foundGroupByName('TeamA_Members');
    $teamaAdminGroup = $this->foundGroupByName('TeamA_Administrators');

    $asset           = Table::getInstance('asset');
    $asset->loadByName('com_teama');
    $rules = [
      'core.create' => [$teamaAdminGroup->id => 1],
      'core.edit' => [$teamaAdminGroup->id => 1],
      'news.create' => [$teamaAdminGroup->id => 1],
      'news.edit'   => [$teamaAdminGroup->id => 1],
      'news.delete' => [$teamaAdminGroup->id => 1],
      'news.read'   => [$teamAMembers->id => 1]
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

    $rules['core.create'][$teamaAdminGroup->id] = 1;
    $rules['core.edit'][$teamaAdminGroup->id] = 1;
    $rules['news.create'][$teamaAdminGroup->id] = 1;
    $rules['news.edit'][$teamaAdminGroup->id] = 1;
    $rules['news.delete'][$teamaAdminGroup->id] = 1;
    $rules['news.read'][$teamAMembers->id] = 1;
    $teamA_asset['rules'] = json_encode($rules);

    $asset->save($teamA_asset);

    $asset->loadByName('com_media');
    $media_asset = $asset->getProperties();
	  $rules = json_decode($media_asset['rules'], true);
	  $rules['core.create'][$teamaAdminGroup->id] = 1;
	  $rules['core.edit'][$teamaAdminGroup->id] = 1;
	  $rules['core.delete'][$teamaAdminGroup->id] = 1;
	  $rules['core.manage'][$teamaAdminGroup->id] = 1;
    $media_asset['rules'] = json_encode($rules);
	  $asset->save($media_asset);
  }

}
