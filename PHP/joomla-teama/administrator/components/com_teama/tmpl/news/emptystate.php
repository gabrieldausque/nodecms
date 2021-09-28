<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

$displayData = [
  'textPrefix' => 'COM_TEAMA',
  'formUrl' => 'index.php?option=com_teama',
  'helpUrl' => 'https://www.google.fr',
  'icon' => 'icon-copy'
];

$user = Factory::getApplication()->getIdentity();

if($user->authorise('core.create','com_teama') ||
   count($user->getAuthorisedCategories('com_teama', 'core.create'))
)
{
  $displayData['createUrl'] = 'index.php?option=com_teama&task=onenews.add';
}

echo LayoutHelper::render('joomla.content.emptystate', $displayData);