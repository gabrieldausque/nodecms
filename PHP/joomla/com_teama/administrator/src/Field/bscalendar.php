<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Administrator\Field
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

use Joomla\CMS\Factory;

class JFormFieldBSCalendar extends \Joomla\CMS\Form\Field\CalendarField
{
	protected function getInput()
	{
		$user = Factory::getApplication()->getIdentity();

		// If a known filter is given use it.
		switch (strtoupper($this->filter))
		{
			case 'SERVER_UTC':
				// Convert a date to UTC based on the server timezone.
				if ($this->value && $this->value != Factory::getDbo()->getNullDate())
				{
					// Get a date object based on the correct timezone.
					$date = Factory::getDate($this->value, 'UTC');
					$date->setTimezone(new \DateTimeZone(Factory::getApplication()->get('offset')));

					// Transform the date string.
					$this->value = $date->format('Y-m-d H:i:s', true, false);
				}
				break;
			case 'USER_UTC':
				// Convert a date to UTC based on the user timezone.
				if ($this->value && $this->value != Factory::getDbo()->getNullDate())
				{
					// Get a date object based on the correct timezone.
					$dateValue = is_string($this->value)?
						$this->value:
						$this->value->format('Y-m-d H:i:s');
					$date = Factory::getDate($dateValue, 'UTC');
					$date->setTimezone($user->getTimezone());

					// Transform the date string.
					$this->value = $date->format('Y-m-d H:i:s', true, false);
				}
				break;
		}

		// Format value when not nulldate ('0000-00-00 00:00:00'), otherwise blank it as it would result in 1970-01-01.
		if ($this->value && $this->value != Factory::getDbo()->getNullDate() && strtotime($this->value) !== false)
		{
			$tz = date_default_timezone_get();
			date_default_timezone_set('UTC');
			$this->value = strftime($this->format, strtotime($this->value));
			date_default_timezone_set($tz);
		}
		else
		{
			$this->value = '';
		}

		return $this->getRenderer($this->layout)->render($this->getLayoutData());

	}
}