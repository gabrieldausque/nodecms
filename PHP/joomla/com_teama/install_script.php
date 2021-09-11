<?php
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
class com_teamaInstallerScript
{
	public function install($parent)
	{
	}

	public function uninstall($parent)
	{
	}

	public function update($parent)
	{
	}

	public function preflight($type, $parent)
	{
	}

	public function postflight($type, $parent)
	{
		$app = Factory::getApplication();
	}
}
