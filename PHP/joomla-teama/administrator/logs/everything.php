#
#<?php die('Forbidden.'); ?>
#Date: 2022-01-25 09:27:02 UTC
#Software: Joomla! 4.0.5 Stable [ Furaha ] 11-December-2021 20:52 GMT

#Fields: datetime	priority clientip	category	message
2022-01-25T09:27:02+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T09:27:02+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T09:30:56+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/TeamAViewOneItem.php(46): Joomla\CMS\MVC\View\HtmlView->display()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/e/workspac...')
#12 {main}
2022-01-25T09:32:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_categories.edit.category.15 Array (     [0] => 15 ) 
2022-01-25T09:32:20+00:00	INFO 127.0.0.1	controller	Checking edit ID com_categories.edit.category.15: 1 Array (     [0] => 15 ) 
2022-01-25T09:32:55+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_categories.edit.category.15 Array ( ) 
2022-01-25T09:33:05+00:00	INFO 127.0.0.1	controller	Holding edit ID com_categories.edit.category.15 Array (     [0] => 15 ) 
2022-01-25T09:33:05+00:00	INFO 127.0.0.1	controller	Checking edit ID com_categories.edit.category.15: 1 Array (     [0] => 15 ) 
2022-01-25T09:33:07+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_categories.edit.category.15 Array ( ) 
2022-01-25T09:33:25+00:00	INFO 127.0.0.1	controller	Holding edit ID com_categories.edit.category.14 Array (     [0] => 14 ) 
2022-01-25T09:33:25+00:00	INFO 127.0.0.1	controller	Checking edit ID com_categories.edit.category.14: 1 Array (     [0] => 14 ) 
2022-01-25T09:33:44+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_categories.edit.category.14 Array ( ) 
2022-01-25T09:37:19+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.1 Array (     [0] => 1 ) 
2022-01-25T09:37:23+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.1 Array ( ) 
2022-01-25T09:37:30+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.1 Array (     [0] => 1 ) 
2022-01-25T09:37:37+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.1 Array (     [0] => 1 ) 
2022-01-25T09:37:40+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.1 Array ( ) 
2022-01-25T09:38:13+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2022-01-25T09:39:36+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : offshoots, html, site". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#11 {main}
2022-01-25T09:40:09+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:40:11+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:40:18+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:40:55+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:41:39+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 400.18 seconds
2022-01-25T09:41:39+00:00	WARNING 127.0.0.1	updater	Error parsing url: https://update.joomla.org/core/list.xml
2022-01-25T09:42:30+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:35+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:36+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:36+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:36+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:57+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:42:58+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:43:02+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:43:45+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:43:45+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:43:57+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:43:57+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:17+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:17+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:41+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:41+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:55+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:44:55+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:45:14+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:45:14+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:45:44+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:45:44+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:46:05+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:46:05+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:50:13+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:50:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:51:33+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:51:53+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Column 'title' in where clause is ambiguous". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamAListModel.php(49): Joomla\Database\DatabaseDriver->setQuery()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Model/NewsModel.php(46): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->_getList()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getNews()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(22): Joomla\CMS\MVC\View\AbstractView->get()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#17 {main}
2022-01-25T09:52:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T09:52:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T09:52:39+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.543 Array (     [0] => 543 ) 
2022-01-25T09:52:45+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.543 Array ( ) 
2022-01-25T09:53:01+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T09:53:01+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T10:39:41+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T10:39:41+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-25T10:52:18+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T10:52:18+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-25T10:52:44+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:53:34+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:54:22+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:55:31+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:57:55+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:58:20+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T10:58:47+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T11:00:38+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T11:01:51+00:00	WARNING 127.0.0.1	jerror	Copy file failed
2022-01-25T11:02:29+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML
2022-01-25T11:02:29+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML
2022-01-25T11:03:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : offshoots, html, site". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#11 {main}
2022-01-27T09:22:47+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type RuntimeException thrown with message "Asset registry file "media/legacy/joomla.asset.json" contains invalid JSON". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/WebAsset/WebAssetRegistry.php(347): Joomla\CMS\WebAsset\WebAssetRegistry->parseRegistryFile()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/WebAsset/WebAssetRegistry.php(128): Joomla\CMS\WebAsset\WebAssetRegistry->parseRegistryFiles()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/WebAsset/WebAssetManager.php(257): Joomla\CMS\WebAsset\WebAssetRegistry->get()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/WebAsset/WebAssetManager.php(181): Joomla\CMS\WebAsset\WebAssetManager->useAsset()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/plugins/system/webauthn/src/PluginTraits/AdditionalLoginButtons.php(201): Joomla\CMS\WebAsset\WebAssetManager->__call()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/plugins/system/webauthn/src/PluginTraits/AdditionalLoginButtons.php(137): PlgSystemWebauthn->addLoginCSSAndJavascript()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Plugin/CMSPlugin.php(285): PlgSystemWebauthn->onUserLoginButtons()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/event/src/Dispatcher.php(486): Joomla\CMS\Plugin\CMSPlugin->Joomla\CMS\Plugin\{closure}()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/EventAware.php(111): Joomla\Event\Dispatcher->dispatch()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Helper/AuthenticationHelper.php(127): Joomla\CMS\Application\WebApplication->triggerEvent()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/modules/mod_login/mod_login.php(18): Joomla\CMS\Helper\AuthenticationHelper::getLoginButtons()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ModuleDispatcher.php(54): include('/mnt/e/workspac...')
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ModuleDispatcher.php(57): Joomla\CMS\Dispatcher\ModuleDispatcher::Joomla\CMS\Dispatcher\{closure}()
#13 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Helper/ModuleHelper.php(295): Joomla\CMS\Dispatcher\ModuleDispatcher->dispatch()
#14 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Helper/ModuleHelper.php(167): Joomla\CMS\Helper\ModuleHelper::renderRawModule()
#15 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_login/tmpl/login/default.php(20): Joomla\CMS\Helper\ModuleHelper::renderModule()
#16 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/mnt/e/workspac...')
#17 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#18 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): Joomla\CMS\MVC\View\HtmlView->display()
#19 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_login/src/Controller/DisplayController.php(61): Joomla\CMS\MVC\Controller\BaseController->display()
#20 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Login\Administrator\Controller\DisplayController->display()
#21 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#22 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_login/src/Dispatcher/Dispatcher.php(43): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#23 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\Component\Login\Administrator\Dispatcher\Dispatcher->dispatch()
#24 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#25 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#26 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#27 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#28 /mnt/e/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/e/workspac...')
#29 {main}
2022-01-27T09:22:57+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\OneNews' not found". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getTop5News()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\AbstractView->get()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#13 {main}
2022-01-27T09:23:00+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\OneNews' not found". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getTop5News()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\AbstractView->get()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#13 {main}
2022-01-27T09:25:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:25:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:25:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:25:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:25:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:25:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:26:00+00:00	INFO 127.0.0.1	joomlafailure	Le nom d'utilisateur ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-27T09:26:00+00:00	WARNING 127.0.0.1	jerror	Le nom d'utilisateur ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-27T09:26:00+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:26:00+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T09:26:50+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : offshoots, html, site". Stack trace: #0 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/e/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/e/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/e/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/e/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/e/workspac...')
#11 {main}
2022-01-27T10:01:26+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T10:01:26+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T10:02:04+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-27T10:02:04+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2022-01-27T10:31:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-27T10:31:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-22T21:41:15+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-22T21:41:15+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-22T21:41:16+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.25 seconds
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 22 Feb 2022 22:41:16 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <WLpv2DJxHg7SShlnb1175Z7u7lcYVT32lootCkIzPA@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 22 Feb 2022 22:41:16 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <PNIxODA3kPyspwEmO3NGJj0SZBs8l2pzQNBpo3HAlPg@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-22T21:41:16+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-22T21:41:16+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2022-02-23T08:18:28+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T08:18:28+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T08:18:28+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.10 seconds
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Wed, 23 Feb 2022 09:18:28 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <jrO2pM6USB89dwncc2vzsHW49NUU1G16ulYvh0QeRU@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Wed, 23 Feb 2022 09:18:28 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <YgltbIKbYG8IkCHESVI8SXkhoXiI0sneujQoct8mLI@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-23T08:18:28+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-23T08:18:28+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2022-02-23T08:19:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.17 seconds
2022-02-23T08:19:48+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.08 seconds
2022-02-23T08:31:35+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot instantiate abstract class TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAModel". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(585): Joomla\CMS\MVC\Factory\MVCFactory->createModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(768): Joomla\CMS\MVC\Controller\BaseController->createModel()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(644): Joomla\CMS\MVC\Controller\BaseController->getModel()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2022-02-23T08:32:27+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot instantiate abstract class TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAModel". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(585): Joomla\CMS\MVC\Factory\MVCFactory->createModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(768): Joomla\CMS\MVC\Controller\BaseController->createModel()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(644): Joomla\CMS\MVC\Controller\BaseController->getModel()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2022-02-23T08:38:33+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot instantiate abstract class TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAModel". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(585): Joomla\CMS\MVC\Factory\MVCFactory->createModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(768): Joomla\CMS\MVC\Controller\BaseController->createModel()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(644): Joomla\CMS\MVC\Controller\BaseController->getModel()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2022-02-23T08:40:17+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Typed property TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel::$tableName must be string, Joomla\CMS\MVC\Factory\MVCFactory used". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Factory/MVCFactory.php(121): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->__construct()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(585): Joomla\CMS\MVC\Factory\MVCFactory->createModel()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(768): Joomla\CMS\MVC\Controller\BaseController->createModel()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(644): Joomla\CMS\MVC\Controller\BaseController->getModel()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-23T08:41:34+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Typed property TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAModel::$tableName must be string, Joomla\CMS\MVC\Factory\MVCFactory used". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Factory/MVCFactory.php(121): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAListModel->__construct()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(585): Joomla\CMS\MVC\Factory\MVCFactory->createModel()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(768): Joomla\CMS\MVC\Controller\BaseController->createModel()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(644): Joomla\CMS\MVC\Controller\BaseController->getModel()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-23T08:53:42+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:05:59+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:06:13+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:14:57+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:15:03+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2022-02-23T10:15:04+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.07 seconds
2022-02-23T10:15:04+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.08 seconds
2022-02-23T10:15:44+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Component\Exception\MissingComponentException thrown with message "Composant introuvable". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#5 {main}
2022-02-23T10:16:09+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\OnenewsModel' not found". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla/com_teama/install_script.php(36): Com_TeamAInstallerScript->createTeamACategories()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(1104): Com_TeamAInstallerScript->install()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(839): Joomla\CMS\Installer\InstallerAdapter->triggerManifestScript()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/Installer.php(520): Joomla\CMS\Installer\InstallerAdapter->install()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Model/InstallModel.php(206): Joomla\CMS\Installer\Installer->install()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Controller/InstallController.php(50): Joomla\Component\Installer\Administrator\Model\InstallModel->install()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Installer\Administrator\Controller\InstallController->install()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-23T10:19:19+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML Joomla!
2022-02-23T10:19:19+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML Joomla!
2022-02-23T10:19:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\OnenewsModel' not found". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla/com_teama/install_script.php(58): Com_TeamAInstallerScript->updateCategories()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(1104): Com_TeamAInstallerScript->update()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(839): Joomla\CMS\Installer\InstallerAdapter->triggerManifestScript()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/Installer.php(520): Joomla\CMS\Installer\InstallerAdapter->install()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Model/InstallModel.php(206): Joomla\CMS\Installer\Installer->install()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Controller/InstallController.php(50): Joomla\Component\Installer\Administrator\Model\InstallModel->install()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Installer\Administrator\Controller\InstallController->install()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-23T10:24:47+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML Joomla!
2022-02-23T10:24:47+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: impossible de trouver un fichier d'initialisation XML Joomla!
2022-02-23T10:25:58+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.8 Array (     [0] => 8 ) 
2022-02-23T10:26:03+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.8 Array ( ) 
2022-02-23T10:26:38+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.9 Array (     [0] => 9 ) 
2022-02-23T10:26:40+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.9 Array ( ) 
2022-02-23T10:27:04+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:30:02+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:30:03+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:30:40+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:30:41+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:31:24+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:31:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:32:52+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getName() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\View\AbstractView->setModel()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2022-02-23T10:37:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T10:37:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T10:37:18+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T10:37:18+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T11:19:38+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T11:19:38+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T11:20:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T11:20:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.14, falling back to com_teama
2022-02-23T11:30:15+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.7 Array (     [0] => 7 ) 
2022-02-23T11:30:27+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.7 Array (     [0] => 7 ) 
2022-02-23T11:30:36+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.7 Array ( ) 
2022-02-23T12:10:57+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T12:10:57+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T12:41:46+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T12:41:46+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T13:51:53+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.3 Array (     [0] => 3 ) 
2022-02-23T13:51:57+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.3 Array ( ) 
2022-02-23T13:52:51+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.4 Array (     [0] => 4 ) 
2022-02-23T13:52:54+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.4 Array ( ) 
2022-02-23T13:53:01+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot use object of type stdClass as array". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/TeamAFrontendView.php(24): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\TeamAFrontendView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-23T14:34:44+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T14:34:44+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T14:52:47+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.5 Array (     [0] => 5 ) 
2022-02-23T14:52:49+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.5 Array ( ) 
2022-02-23T15:25:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T15:25:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T15:46:13+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T15:46:13+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T15:50:26+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.4 Array (     [0] => 4 ) 
2022-02-23T15:50:32+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.4 Array (     [0] => 4 ) 
2022-02-23T16:07:29+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.4 Array ( ) 
2022-02-23T20:44:44+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.12 seconds
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Wed, 23 Feb 2022 21:44:44 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <9jIEtT4XzkoA8WVHK3zokhAFqJkSxsSm03YtOfSeI5U@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Wed, 23 Feb 2022 21:44:44 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <i8s5LlYLleLrgKC411U3V4T6d3N5FIsgsuRQVfcOHQY@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-23T20:44:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-23T20:44:44+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2022-02-23T20:45:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T20:45:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-23T20:47:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.6 Array (     [0] => 6 ) 
2022-02-23T20:47:25+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.6 Array ( ) 
2022-02-24T08:42:37+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.09 seconds
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Thu, 24 Feb 2022 09:42:37 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <DZ5V26qDyHGIar70Bdi0M1uXsW17g91nv2UejmlE@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Thu, 24 Feb 2022 09:42:37 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <rV5S707SOQS0AI06zpW2A5ofxEmvxStIUxcR2mhDHsA@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2022-02-24T08:42:37+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2022-02-24T08:42:37+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2022-02-24T08:47:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T08:47:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T10:55:45+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T10:55:45+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T10:58:45+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2022-02-24T10:58:45+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.06 seconds
2022-02-24T10:58:46+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.13 seconds
2022-02-24T10:58:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.07 seconds
2022-02-24T10:59:08+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.07 seconds
2022-02-24T10:59:17+00:00	INFO 127.0.0.1	update	Mise à jour lancée par l'utilisateur admin_teama (461). L'ancienne version est &#x200E;4.0.5.
2022-02-24T10:59:18+00:00	INFO 127.0.0.1	update	Téléchargement du fichier de mise à jour depuis https://downloads.joomla.org/cms/joomla4/4-1-0/Joomla_4.1.0-Stable-Update_Package.zip.
2022-02-24T10:59:30+00:00	INFO 127.0.0.1	update	Fichier Joomla_4.1.0-Stable-Update_Package.zip téléchargé.
2022-02-24T10:59:30+00:00	INFO 127.0.0.1	update	Lancement de l'installation de la nouvelle version.
2022-02-24T10:59:52+00:00	INFO 127.0.0.1	update	Conclusion de l'installation.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	The current database version (schema) is 4.0.3-2021-09-05.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.0.6-2021-12-23. Texte de la requête: UPDATE `#__extensions` SET `checked_out` = NULL WHERE `type` = 'package' AND `el.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: CREATE TABLE IF NOT EXISTS `#__scheduler_tasks` (   `id` int unsigned NOT NULL A.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: INSERT INTO `#__extensions` (`package_id`, `name`, `type`, `element`, `folder`, .
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: INSERT INTO `#__extensions` (`package_id`, `name`, `type`, `element`, `folder`, .
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: INSERT INTO `#__action_logs_extensions` (`extension`) VALUES ('com_scheduler');.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: INSERT INTO `#__action_log_config` (`type_title`, `type_alias`, `id_holder`, `ti.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-20. Texte de la requête: INSERT INTO `#__mail_templates` (`template_id`, `extension`, `language`, `subjec.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-28. Texte de la requête: UPDATE `#__template_styles` SET `inheritable` = 1 WHERE `template` = 'atum' AND .
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-11-28. Texte de la requête: UPDATE `#__template_styles`    SET `params` = REPLACE(`params`,'"useFontScheme":.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2021-12-29. Texte de la requête: INSERT INTO `#__extensions` (`name`, `type`, `element`, `folder`, `client_id`, `.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2022-01-08. Texte de la requête: UPDATE `#__mail_templates`    SET `params` = '{"tags": ["task_id", "task_title"].
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2022-01-19. Texte de la requête: INSERT INTO `#__extensions` (`name`, `type`, `element`, `folder`, `client_id`, `.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2022-01-24. Texte de la requête: ALTER TABLE `#__redirect_links` DROP INDEX `idx_link_modifed`;.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 4.1.0-2022-01-24. Texte de la requête: ALTER TABLE `#__redirect_links` ADD INDEX `idx_link_modified` (`modified_date`);.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T10:59:53+00:00	INFO 127.0.0.1	update	Effacement des fichiers et dossiers à supprimer.
2022-02-24T10:59:58+00:00	INFO 127.0.0.1	update	Mise en ordre après installation.
2022-02-24T10:59:58+00:00	INFO 127.0.0.1	update	La mise à jour vers la version 4.1.0 est achevée.
2022-02-24T10:59:58+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.10 seconds
2022-02-24T12:27:45+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T12:27:45+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T12:28:01+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.21 seconds
2022-02-24T12:28:02+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.45 seconds
2022-02-24T12:28:02+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.26 seconds
2022-02-24T12:33:06+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.903 Array (     [0] => 903 ) 
2022-02-24T12:33:21+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.903 Array ( ) 
2022-02-24T12:37:01+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.17, falling back to com_teama
2022-02-24T12:37:01+00:00	WARNING 127.0.0.1	assets	No asset found for com_teama.category.17, falling back to com_teama
2022-02-24T12:38:48+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2022-02-24T12:42:15+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T12:42:15+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.28.
2022-02-24T12:42:15+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T12:55:46+00:00	INFO 127.0.0.1	controller	Holding edit ID com_categories.edit.category.19 Array (     [0] => 19 ) 
2022-02-24T12:55:46+00:00	INFO 127.0.0.1	controller	Checking edit ID com_categories.edit.category.19: 1 Array (     [0] => 19 ) 
2022-02-24T12:56:02+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_categories.edit.category.19 Array ( ) 
2022-02-24T13:21:29+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T13:21:29+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-02-24T13:21:58+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:21:58+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:21:58+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:24:48+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:24:48+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:24:48+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:30:28+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:30:28+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:30:28+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:35:40+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:35:40+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:35:40+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:37:50+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.7 Array (     [0] => 7 ) 
2022-02-24T13:38:30+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to undefined method TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView::isRhNews()". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(431): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(220): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(23): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(697): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(735): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(204): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(243): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2022-02-24T13:42:37+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.7 Array ( ) 
2022-02-24T13:42:53+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:42:53+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:42:53+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:47:13+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:47:13+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:47:13+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:48:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\View\News\OnenewsModel' not found". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/news/default.php(33): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->isRHNews()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(431): include('/mnt/c/workspac...')
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(220): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(23): Joomla\CMS\MVC\View\HtmlView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(697): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(735): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(204): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(243): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#15 {main}
2022-02-24T13:49:20+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:49:20+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:49:20+00:00	INFO 127.0.0.1	update	End of SQL updates.
2022-02-24T13:55:31+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2022-02-24T13:55:31+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.30.
2022-02-24T13:55:31+00:00	INFO 127.0.0.1	update	End of SQL updates.
