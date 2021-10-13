#
#<?php die('Forbidden.'); ?>
#Date: 2021-10-11 16:36:02 UTC
#Software: Joomla! 4.0.3 Stable [ Furaha ] 12-September-2021 10:39 GMT

#Fields: datetime	priority clientip	category	message
2021-10-11T16:36:02+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.71 seconds
2021-10-11T16:37:11+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-11T16:37:11+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-11T16:37:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.39 seconds
2021-10-11T16:37:30+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.53 seconds
2021-10-11T16:38:10+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getListFooter() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(23): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
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
2021-10-11T16:40:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getListFooter() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(23): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
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
2021-10-11T16:54:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-11T16:54:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-11T16:55:08+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.2 Array (     [0] => 2 ) 
2021-10-11T16:55:11+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.2 Array ( ) 
2021-10-11T16:55:21+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.3 Array (     [0] => 3 ) 
2021-10-11T16:55:25+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.3 Array ( ) 
2021-10-11T16:55:35+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.4 Array (     [0] => 4 ) 
2021-10-11T16:55:39+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.4 Array ( ) 
2021-10-11T16:55:49+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.5 Array (     [0] => 5 ) 
2021-10-11T16:55:53+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.5 Array ( ) 
2021-10-11T16:56:03+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-11T16:56:07+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.6 Array ( ) 
2021-10-11T16:56:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getListFooter() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
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
2021-10-11T16:56:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getListFooter() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
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
2021-10-12T20:03:27+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-12T20:03:27+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-12T20:03:27+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.08 seconds
2021-10-12T21:45:26+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-12T21:45:26+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T12:42:16+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T12:42:16+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T12:42:17+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.53 seconds
2021-10-13T13:03:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T13:03:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T13:03:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T13:03:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T13:03:58+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.63 seconds
2021-10-13T13:04:00+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.74 seconds
2021-10-13T13:22:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type ParseError thrown with message "syntax error, unexpected '<'". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\HtmlView->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2021-10-13T18:47:56+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2021-10-13T19:57:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-13T19:57:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
