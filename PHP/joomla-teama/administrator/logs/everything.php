#
#<?php die('Forbidden.'); ?>
#Date: 2022-01-26 13:40:50 UTC
#Software: Joomla! 4.0.5 Stable [ Furaha ] 11-December-2021 20:52 GMT

#Fields: datetime	priority clientip	category	message
2022-01-26T13:40:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 20.03 seconds
2022-01-26T13:40:50+00:00	WARNING 127.0.0.1	updater	Error opening url: https://update.joomla.org/core/list.xml for update site: Joomla! Core
2022-01-26T13:43:22+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(16): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#17 {main}
