<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;

$attributes = array();

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
} else {
	$attributes['title'] = $item->title;
}

if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

if ($item->id == $active_id)
{
	$attributes['aria-current'] = 'location';

	if ($item->current)
	{
		$attributes['aria-current'] = 'page';
	}
}

$linktype = '<span class="FirstLetter">' . substr($item->title, 0,1) . '</span>' .
			'<span class="OtherLetters">' . substr($item->title, 1, strlen($item->title) - 1) . '</span>';

if ($item->menu_image)
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css;
		$linktype = HTMLHelper::_('image', $item->menu_image, $item->title, $image_attributes);
	}
	else
	{
		$linktype = HTMLHelper::_('image', $item->menu_image, $item->title);
	}

	if ($itemParams->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

if (!array_key_exists('class', $attributes))
{
	$attributes['class'] = ' nav-link text-white teama-menu-link';
}
else
{
	$attributes['class'] .= ' nav-link text-white teama-menu-link';
}

if ($item->id == $active_id)
{
	$attributes['class'] .= ' active';
}

$iconRegex = '/teamaicon_(?<icon>.+)_teamaicon/';
$matches = [];
if(preg_match($iconRegex, $attributes['class'], $matches)){
	$linktype = '<i class="' . $matches['icon'] . '"></i>' . $linktype;
	preg_replace($iconRegex, '', $attributes['class']);
}

$final = HTMLHelper::_('link', OutputFilter::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)),
	$linktype, $attributes);

echo $final;
