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
    $groups = $groupsModel->getItems();

    if(is_array($groups)){
      foreach($groups as $group){
        if($group->title == $groupName)
          return $group;
      }
    }
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

    if(!$this->foundGroupByName('TeamA_Administrators')){
      $groupModel->save([
        'id' =>0,
        'parent_id'=> $teamAMembers->id,
        'title' => 'TeamA_Administrators'
      ]);
	    $teamaAdminGroup = $this->foundGroupByName('TeamA_Administrators');
	    $asset = Table::getInstance('asset');
	    $asset->loadByName('com_teama');
	    $newRule = [
		    'rules' => json_encode([
			    'core.create' => [$teamaAdminGroup->id => [1]],
			    'core.edit' => [$teamaAdminGroup->id => [1]],
			    'core.delete' => [$teamaAdminGroup->id => [1]],
			    'news.create' => [$teamaAdminGroup->id => [1]],
			    'news.edit' => [$teamaAdminGroup->id => [1]],
			    'news.delete' => [$teamaAdminGroup->id => [1]],
		    ]),
		    'name'=> 'com_teama',
		    'title'=>'Team-A'
	    ];
	    $asset->save($newRule);
    }

    return true;
  }

	public function update($parent) : bool
	{
	  if(!$this->createTeamAGroups()){
	    return false;
    }

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
}
