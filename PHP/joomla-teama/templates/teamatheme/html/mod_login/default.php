<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

$app->getDocument()->getWebAssetManager()
	->useScript('core')
	->useScript('keepalive')
	->useScript('field.passwordview');

Text::script('JSHOWPASSWORD');
Text::script('JHIDEPASSWORD');
?>
<form id="teama-login-form" class="mod-login" action="<?php echo Route::_('index.php', true); ?>" method="post">

	<?php if ($params->get('pretext')) : ?>
		<div class="mod-login__pretext pretext">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>

	<div class="mod-login__userdata userdata">
		<div class="mod-login__username form-group">
			<?php if (!$params->get('usetext', 0)) : ?>
				<div class="mb-3 input-group">
					<input id="modlgn-username-<?php echo $module->id; ?>" type="text" name="username" class="form-control" autocomplete="username" placeholder="<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>">
					<label for="modlgn-username-<?php echo $module->id; ?>" class="visually-hidden"><?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
					<span class="input-group-text" title="<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>">
						<span class="icon-user icon-fw" aria-hidden="true"></span>
					</span>
				</div>
			<?php else : ?>
				<label for="modlgn-username-<?php echo $module->id; ?>"><?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
				<input id="modlgn-username-<?php echo $module->id; ?>" type="text" name="username" class="form-control" autocomplete="username" placeholder="<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>">
			<?php endif; ?>
		</div>

		<div class="mod-login__password form-group">
			<?php if (!$params->get('usetext', 0)) : ?>
				<div class="input-group">
					<input id="modlgn-passwd-<?php echo $module->id; ?>" type="password" name="password" autocomplete="current-password" class="form-control" placeholder="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>">
					<label for="modlgn-passwd-<?php echo $module->id; ?>" class="visually-hidden"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
					<button type="button" class="btn btn-secondary input-password-toggle">
						<span class="icon-eye icon-fw" aria-hidden="true"></span>
						<span class="visually-hidden"><?php echo Text::_('JSHOWPASSWORD'); ?></span>
					</button>
				</div>
			<?php else : ?>
				<label for="modlgn-passwd-<?php echo $module->id; ?>"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
				<input id="modlgn-passwd-<?php echo $module->id; ?>" type="password" name="password" autocomplete="current-password" class="form-control" placeholder="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>">
			<?php endif; ?>
		</div>

		<?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
			<div class="mod-login__remember form-group">
				<div id="form-login-remember-<?php echo $module->id; ?>" class="form-check">
					<label class="form-check-label">
						<input type="checkbox" name="remember" class="form-check-input" value="yes">
						<?php echo Text::_('MOD_LOGIN_REMEMBER_ME'); ?>
					</label>
				</div>
			</div>
		<?php endif; ?>

		<?php
			$usersConfig = ComponentHelper::getParams('com_users'); ?>
		<input type="hidden" name="option" value="com_users">
		<input type="hidden" name="task" value="user.login">
		<input type="hidden" name="return" value="<?php echo $return; ?>">
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="mod-login__posttext posttext">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
