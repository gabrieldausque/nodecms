<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['type' => 'module']);
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu-es5.min.js', [], ['nomodule' => true, 'defer' => true]);

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}
?>
<ul<?php echo $id; ?> class="mod-menu mod-list nav nav-pills flex-column mb-auto <?php echo $class_sfx; ?>">
<?php foreach ($list as $i => &$item)
{
	$itemParams = $item->getParams();
	$class      = 'item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $itemParams->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	$deeperId = $item->alias . '-submenu';
    $hasChildActive = false;

	echo '<li class="' . $class . ' nav-item">';
	if($item->deeper) {
        $subMenuClass = 'teama-submenu';
        $allChildren = $item->getChildren(true);
        foreach($allChildren as $child){
            $hasChildActive = $item->id == $active_id ||
                $item->id == $active->parent_id;
            if($hasChildActive)
                break;
        }

        if($item->id == $active_id)
            $subMenuClass .= ' active';

		echo '<div class="' . $subMenuClass . '" >';
	}

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{

		echo '<button class="btn btn-toggle align-items-center rounded btn-submenu';
		if($hasChildActive)
			echo ' show-submenu';
		echo '" data-bs-toggle="collapse" data-bs-target="#' . $deeperId . '" aria-expanded="true">';
		echo '<i class="fas fa-chevron-right"></i></button>';


		echo '</div>';
		echo '<ul id="' . $deeperId . '" class="mod-menu__sub list-unstyled small collapse';
		if($hasChildActive)
		    echo ' show';
		echo '">';
	}

	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>
