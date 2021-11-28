<?php

namespace TheLoneBlackSheep\Component\TeamA\Administrator\Helpers;

\defined('_JEXEC') or die('Access Restricted');

use Joomla\Component\Users\Administrator\Model\GroupModel;

class UserHelpers {

	static function IsUserRH($user){
		$isRH = false;
		$groupModel = new GroupModel();
		foreach ($user->getAuthorisedGroups() as $groupId){
			$group = $groupModel->getItem($groupId);
			if($group->title == "TeamA_HumanResources"){
				$isRH = true;
				break;
			}
		}
		return $isRH;
	}

}