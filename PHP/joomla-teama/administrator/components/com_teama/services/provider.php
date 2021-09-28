<?php
/**
 * @copyright 2021 Gabriel DAUSQUE
 * @license GNU/GPL https://www.gnu.org/licenses/gpl-3.0.fr.html
 */
namespace TeamA;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use TheLoneBlackSheep\Component\TeamA\Administrator\Extension\TeamAComponent;

/**
 * @since version 0.0.1;
 */
class TeamAServiceProvider implements ServiceProviderInterface
{
	/**
	 * @since version 0.0.1
	 * @param   Container $container The container to inject service in it
	 * @return void
	 */
	public function register( Container $container )
	{
		$container->registerServiceProvider(new CategoryFactory('\\TheLoneBlackSheep\\Component\\TeamA'));
		$container->registerServiceProvider(new MVCFactory('\\TheLoneBlackSheep\\Component\\TeamA'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\TheLoneBlackSheep\\Component\\TeamA'));

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new TeamAComponent($container->get(ComponentDispatcherFactoryInterface::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
				$component->setRegistry($container->get(Registry::class));

				return $component;
			}
		);
	}
}

return new TeamAServiceProvider;

