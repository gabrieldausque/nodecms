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

/**
 * @since 0.0.1
 */
class Com_TeamAInstallerScript
{
	private $minimumJoomlaVersion = '4.0';

	private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;

	public function install($parent) : bool
	{
		return true;
	}

	public function uninstall($parent) : bool
	{
		return true;
	}

	public function update($parent) : bool
	{
		return true;
	}

	public function preflight($type, $parent) : bool
	{
		if ($type !== 'uninstall') {
			if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<'))
			{
				Log::add(
					Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion,
						Log::WARNING,
						'jerror'
					)
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
		$app = Factory::getApplication();

		return true;
	}
}
