<?php
/**
 * @copyright 2021 Gabriel DAUSQUE
 * @license GNU/GPL https://www.gnu.org/licenses/gpl-3.0.fr.html
 */
namespace TeamA;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Categories\CategoryFactory;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactory;
use Joomla\CMS\MVC\Factory\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use TeamA\Component\Core\TeamAComponent;

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
		$container->registerServiceProvider(new CategoryFactory('\\TeamA\\Component\\Core'));
		$container->registerServiceProvider(new MVCFactory('\\TeamA\\Component\\Core'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\TeamA\\Component\\Core'));

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new TeamAComponent($container->get(ComponentDispatcherFactory::class));
				$component->setRegistry($container->get(Registry::class));

				return $component;
			}
		);
	}
}

return new TeamAServiceProvider();

