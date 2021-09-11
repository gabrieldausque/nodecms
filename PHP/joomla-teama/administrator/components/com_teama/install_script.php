<?php
defined('_JEXEC') or die('Restricted access');

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
		echo '<p> Parent class' . get_class($parent) . '</p>';
	}
}
