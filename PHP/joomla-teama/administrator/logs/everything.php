#
#<?php die('Forbidden.'); ?>
#Date: 2021-10-18 13:49:47 UTC
#Software: Joomla! 4.0.3 Stable [ Furaha ] 12-September-2021 10:39 GMT

#Fields: datetime	priority clientip	category	message
2021-10-18T13:49:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2021-10-18T13:49:59+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-18T13:49:59+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-18T13:51:19+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.05 seconds
2021-10-18T13:51:19+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.03 seconds
2021-10-18T13:51:37+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.12. Texte de la requête: alter table #__teama_news     add column if not exists summary varchar(2096) not.
2021-10-18T13:54:12+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-18T13:55:00+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-18T13:55:04+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.1 Array ( ) 
2021-10-18T16:22:27+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-18T16:22:27+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-18T16:22:27+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.47 seconds
2021-10-18T16:28:38+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.40 seconds
2021-10-18T16:28:40+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.60 seconds
2021-10-18T16:29:42+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type InvalidArgumentException thrown with message "Erreur de chargement du menu&#160;: administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Menu/AbstractMenu.php(115): Joomla\CMS\Menu\MenuFactory->createMenu()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(515): Joomla\CMS\Menu\AbstractMenu::getInstance()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(781): Joomla\CMS\Application\CMSApplication->getMenu()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_privacy/src/Controller/DisplayController.php(120): Joomla\CMS\MVC\Controller\BaseController->getModel()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Privacy\Administrator\Controller\DisplayController->getNumberUrgentRequests()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#12 {main}
2021-10-18T16:29:43+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type InvalidArgumentException thrown with message "Erreur de chargement du menu&#160;: administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Menu/AbstractMenu.php(115): Joomla\CMS\Menu\MenuFactory->createMenu()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(515): Joomla\CMS\Menu\AbstractMenu::getInstance()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(781): Joomla\CMS\Application\CMSApplication->getMenu()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_templates/src/Controller/TemplateController.php(258): Joomla\CMS\MVC\Controller\BaseController->getModel()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_templates/src/Controller/TemplateController.php(975): Joomla\Component\Templates\Administrator\Controller\TemplateController->getModel()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Templates\Administrator\Controller\TemplateController->ajax()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2021-10-18T16:30:59+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-18T16:31:12+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.6 Array ( ) 
2021-10-18T16:31:48+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-18T16:32:45+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-18T16:32:50+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.6 Array ( ) 
2021-10-18T16:32:55+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-18T17:07:42+00:00	WARNING 127.0.0.1	jerror	Erreur de copie&nbsp;: /mnt/c/workspaces/nodecms/PHP/joomla/com_teama/ vers /mnt/c/workspaces/nodecms/PHP/joomla-teama/media/
2021-10-18T17:07:42+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: échec de la copie du fichier /mnt/c/workspaces/nodecms/PHP/joomla/com_teama/ vers /mnt/c/workspaces/nodecms/PHP/joomla-teama/media/
2021-10-19T06:01:54+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.18 seconds
2021-10-19T06:02:00+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T06:02:00+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T07:41:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T07:41:12+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T07:41:12+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.18 seconds
2021-10-19T07:51:40+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.29 seconds
2021-10-19T07:51:40+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.03 seconds
2021-10-19T07:53:27+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.197 Array (     [0] => 197 ) 
2021-10-19T07:53:59+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.197 Array ( ) 
2021-10-19T08:13:38+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:17:40+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:18:00+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:23:59+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.13. Texte de la requête: alter table #__teama_news     add column if not exists summary varchar(2096) not.
2021-10-19T08:24:17+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:24:24+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:42:43+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:47:15+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:47:55+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-19T08:48:06+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.1 Array ( ) 
2021-10-19T08:50:38+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:50:47+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:51:17+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:54:00+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T08:54:20+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : onenews, html, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-19T09:12:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T09:12:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T09:13:47+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(15): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-10-19T09:14:32+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(15): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-10-19T09:17:43+00:00	INFO 127.0.0.1	controller	Holding edit ID com_users.edit.group.12 Array (     [0] => 12 ) 
2021-10-19T09:17:43+00:00	INFO 127.0.0.1	controller	Checking edit ID com_users.edit.group.12: 1 Array (     [0] => 12 ) 
2021-10-19T09:17:46+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_users.edit.group.12 Array ( ) 
2021-10-19T09:18:13+00:00	INFO 127.0.0.1	controller	Holding edit ID com_users.edit.group.12 Array (     [0] => 12 ) 
2021-10-19T09:18:13+00:00	INFO 127.0.0.1	controller	Checking edit ID com_users.edit.group.12: 1 Array (     [0] => 12 ) 
2021-10-19T09:18:16+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_users.edit.group.12 Array ( ) 
2021-10-19T10:03:35+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T10:03:35+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-19T10:04:38+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot use object of type stdClass as array". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla/com_teama/install_script.php(105): Com_TeamAInstallerScript->setRules()
#1 /data/workspaces/nodecms/PHP/joomla/com_teama/install_script.php(112): Com_TeamAInstallerScript->createTeamAGroups()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(1104): Com_TeamAInstallerScript->update()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/InstallerAdapter.php(839): Joomla\CMS\Installer\InstallerAdapter->triggerManifestScript()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Installer/Installer.php(520): Joomla\CMS\Installer\InstallerAdapter->install()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Model/InstallModel.php(206): Joomla\CMS\Installer\Installer->install()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_installer/src/Controller/InstallController.php(50): Joomla\Component\Installer\Administrator\Model\InstallModel->install()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\Component\Installer\Administrator\Controller\InstallController->install()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-10-19T13:51:42+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.06 seconds
2021-10-20T12:36:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-20T12:36:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-20T12:36:34+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 1.15 seconds
2021-10-21T06:33:31+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-10-21T06:33:53+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T06:33:53+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T06:34:19+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.26 seconds
2021-10-21T06:34:19+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.03 seconds
2021-10-21T07:46:09+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T07:46:09+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T08:02:59+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T08:02:59+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T08:28:22+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-21T08:28:46+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-21T09:07:54+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.197 Array (     [0] => 197 ) 
2021-10-21T09:08:45+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.197 Array ( ) 
2021-10-21T09:36:43+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T09:36:43+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T09:38:49+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(13): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(15): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-10-21T10:08:40+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T10:08:40+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T10:34:02+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.2 Array (     [0] => 2 ) 
2021-10-21T10:34:04+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.2 Array ( ) 
2021-10-21T10:34:22+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.3 Array (     [0] => 3 ) 
2021-10-21T10:34:24+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.3 Array ( ) 
2021-10-21T10:34:30+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.4 Array (     [0] => 4 ) 
2021-10-21T10:34:33+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.4 Array ( ) 
2021-10-21T10:34:38+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.5 Array (     [0] => 5 ) 
2021-10-21T10:34:40+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.5 Array ( ) 
2021-10-21T10:34:46+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-21T10:35:46+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-21T10:35:48+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.6 Array ( ) 
2021-10-21T10:35:56+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.7 Array (     [0] => 7 ) 
2021-10-21T10:35:57+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.7 Array ( ) 
2021-10-21T10:36:04+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.8 Array (     [0] => 8 ) 
2021-10-21T10:36:06+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.8 Array ( ) 
2021-10-21T10:36:12+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.9 Array (     [0] => 9 ) 
2021-10-21T10:36:13+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.9 Array ( ) 
2021-10-21T12:38:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T12:38:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T12:38:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.06 seconds
2021-10-21T12:43:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.06 seconds
2021-10-21T12:43:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.03 seconds
2021-10-21T13:15:56+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.9 Array (     [0] => 9 ) 
2021-10-21T13:16:03+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.9 Array ( ) 
2021-10-21T13:49:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T13:49:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T14:00:22+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'Text' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(20): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(15): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-21T14:00:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'Text' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(20): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(15): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-21T14:18:41+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'Factory' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(20): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(15): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-21T14:20:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-10-21T14:20:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.04 seconds
2021-10-21T14:20:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.04 seconds
2021-10-21T15:14:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T15:14:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T15:44:56+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-10-21T19:28:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.09 seconds
2021-10-21T19:29:46+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:31:56+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:38:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T19:38:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T19:38:20+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.48 seconds
2021-10-21T19:38:21+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.22 seconds
2021-10-21T19:38:46+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.13. Texte de la requête: alter table #__teama_news     add column if not exists summary varchar(2096) no.
2021-10-21T19:39:07+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:40:20+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:41:35+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(19): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T19:43:18+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(19): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T19:48:27+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:53:14+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T19:58:46+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T19:58:46+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-21T19:59:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(21): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T20:00:21+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(21): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T20:00:32+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(21): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T20:01:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function get() on null". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(21): Joomla\CMS\Session\Session::checkToken()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-10-21T20:03:13+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T20:03:34+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T20:07:58+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-21T20:09:32+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [name, type, prefix] : teama, json, site". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->nextNews()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-10-22T07:18:53+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.06 seconds
2021-10-22T07:18:58+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T07:18:58+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T07:51:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T07:51:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T07:51:43+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.06 seconds
2021-10-22T07:51:43+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.04 seconds
2021-10-22T08:07:25+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot use object of type Joomla\CMS\Pagination\PaginationObject as array". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(20): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(16): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-22T08:39:23+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T08:39:23+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T08:39:40+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.10 Array (     [0] => 10 ) 
2021-10-22T08:39:42+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.10 Array ( ) 
2021-10-22T08:39:54+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.11 Array (     [0] => 11 ) 
2021-10-22T08:39:55+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.11 Array ( ) 
2021-10-22T08:40:09+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.12 Array (     [0] => 12 ) 
2021-10-22T08:40:10+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.12 Array ( ) 
2021-10-22T08:46:40+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.1 Array (     [0] => 1 ) 
2021-10-22T09:39:26+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.13 Array (     [0] => 1     [1] => 13 ) 
2021-10-22T09:39:28+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.13 Array (     [0] => 1 ) 
2021-10-22T09:39:35+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.14 Array (     [0] => 1     [1] => 14 ) 
2021-10-22T09:39:36+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.14 Array (     [0] => 1 ) 
2021-10-22T09:39:43+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.15 Array (     [0] => 1     [1] => 15 ) 
2021-10-22T09:39:44+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.15 Array (     [0] => 1 ) 
2021-10-22T09:39:50+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.16 Array (     [0] => 1     [1] => 16 ) 
2021-10-22T09:39:51+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.16 Array (     [0] => 1 ) 
2021-10-22T09:39:58+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 1     [1] => 17 ) 
2021-10-22T09:40:00+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.17 Array (     [0] => 1 ) 
2021-10-22T10:21:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T10:21:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T10:21:54+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T10:23:33+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T10:27:43+00:00	INFO 127.0.0.1	controller	Holding edit ID com_content.edit.article.1 Array (     [0] => 1 ) 
2021-10-22T10:27:43+00:00	INFO 127.0.0.1	controller	Checking edit ID com_content.edit.article.1: 1 Array (     [0] => 1 ) 
2021-10-22T10:28:30+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T10:36:24+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T10:48:44+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T11:21:04+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T11:21:04+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T12:02:14+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:02:27+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:02:50+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:03:35+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.17 Array ( ) 
2021-10-22T12:07:39+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:10:15+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:16:48+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:19:15+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:19:17+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.17 Array ( ) 
2021-10-22T12:19:23+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T12:22:58+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.17 Array ( ) 
2021-10-22T13:35:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T13:35:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T13:35:32+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-10-22T14:04:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T14:04:06+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T16:26:08+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T16:26:08+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T16:35:48+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T16:35:48+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T16:36:10+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type ParseError thrown with message "syntax error, unexpected '}', expecting end of file". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-22T16:36:58+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type ParseError thrown with message "syntax error, unexpected '}', expecting end of file". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Teama/HtmlView.php(19): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Teama\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-22T16:45:27+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function renderField() on null". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(18): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-22T16:54:56+00:00	WARNING 127.0.0.1	jerror	Joomla\CMS\Filesystem\Folder::delete : Le chemin n'est pas un dossier. Chemin&nbsp;: /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/forms
2021-10-22T16:55:18+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type RuntimeException thrown with message "Form::loadForm could not load file". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(20): Joomla\CMS\MVC\View\AbstractView->get()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-10-22T17:11:34+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T17:17:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T17:17:30+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-22T17:17:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-10-22T17:17:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.03 seconds
2021-10-22T17:17:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.04 seconds
2021-10-22T17:33:02+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-10-22T17:35:33+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T07:45:57+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T07:45:57+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T07:45:57+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.06 seconds
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 2 Nov 2021 08:45:57 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <J6v10hhrNGtNBuJY05AhRihrudIF70CxC60j9WThfeM@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/administrato?=
 =?utf-8?Q?r/?=
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 2 Nov 2021 08:45:57 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <YuYBafFc4kGHwFFtsmrOEXIdYTlKoyN6GlF3Cnjck@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-02T07:45:57+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-02T07:45:57+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2021-10-24T08:40:24+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.56 seconds
2021-10-24T08:41:14+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-25T07:53:09+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.34 seconds
2021-10-25T07:58:16+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T07:58:16+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T07:58:39+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.30 seconds
2021-10-25T07:58:40+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.37 seconds
2021-10-25T08:02:16+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type ParseError thrown with message "syntax error, unexpected 'else' (T_ELSE), expecting ';' or ','". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(20): Joomla\CMS\MVC\View\HtmlView->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/NewsController.php(16): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\NewsController->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#13 {main}
2021-10-25T08:21:43+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-25T08:53:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T08:53:54+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T08:54:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T08:54:14+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T09:07:55+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T09:07:55+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T09:10:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T09:10:36+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T09:10:52+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.65 seconds
2021-10-25T09:10:52+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.63 seconds
2021-10-25T09:10:54+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.65 seconds
2021-10-25T09:11:30+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-25T11:08:13+00:00	WARNING 127.0.0.1	security	PLG_AUTHENTICATION_COOKIE_ERROR_LOG_LOGIN_FAILED
2021-10-25T11:08:13+00:00	INFO 127.0.0.1	joomlafailure	Un mot de passe vide n'est pas autorisé
2021-10-25T12:26:40+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T12:26:40+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T12:27:25+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.34 seconds
2021-10-25T12:27:25+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.35 seconds
2021-10-25T12:27:26+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.34 seconds
2021-10-25T12:39:57+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.543 Array (     [0] => 543 ) 
2021-10-25T12:40:07+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.543 Array ( ) 
2021-10-25T12:40:12+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#6 {main}
2021-10-25T13:07:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T13:07:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T13:12:18+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.33 seconds
2021-10-25T13:13:08+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-25T13:45:49+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T13:45:49+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-25T13:46:12+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.6 Array (     [0] => 6 ) 
2021-10-26T06:06:44+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 10.02 seconds
2021-10-26T06:06:44+00:00	WARNING 127.0.0.1	updater	Error opening url: https://update.joomla.org/core/list.xml for update site: Joomla! Core
2021-10-26T08:18:50+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-10-26T08:18:50+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-01T16:00:23+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.16 seconds
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Mon, 1 Nov 2021 17:00:23 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <F6BDX3FKT1ObffPoEgXK3WjJhdaqTNHsGtjJXVVhW8@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: "gabrieldausque.pro@gmail.com" <gabrieldausque.pro@gmail.com>
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Mise_=C3=A0_jour_de_Joomla_disponible_pour_Team_A_?=
 =?utf-8?Q?=E2=80=93_https://teama.myhost.domain/?=
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Mon, 1 Nov 2021 17:00:23 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <Sw0hGfYfMbIfdmRBZFsX58yXawEKsRhiM6jszZ25w7s@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-01T16:00:23+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-01T16:00:23+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2021-11-01T16:02:19+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-01T16:02:19+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-01T16:02:46+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.29 seconds
2021-11-01T16:02:46+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.06 seconds
2021-11-01T16:02:56+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.06 seconds
2021-11-01T16:03:24+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.08 seconds
2021-11-01T16:03:35+00:00	INFO 127.0.0.1	update	Mise à jour lancée par l'utilisateur admin_teama (461). L'ancienne version est &#x200E;4.0.3.
2021-11-01T16:03:37+00:00	INFO 127.0.0.1	update	Téléchargement du fichier de mise à jour depuis https://downloads.joomla.org/cms/joomla4/4-0-4/Joomla_4.0.4-Stable-Update_Package.zip.
2021-11-01T16:03:45+00:00	INFO 127.0.0.1	update	Fichier Joomla_4.0.4-Stable-Update_Package.zip téléchargé.
2021-11-01T16:03:45+00:00	INFO 127.0.0.1	update	Lancement de l'installation de la nouvelle version.
2021-11-01T16:04:24+00:00	INFO 127.0.0.1	update	Conclusion de l'installation.
2021-11-01T16:04:25+00:00	INFO 127.0.0.1	update	Effacement des fichiers et dossiers à supprimer.
2021-11-01T16:04:29+00:00	INFO 127.0.0.1	update	Mise en ordre après installation.
2021-11-01T16:04:29+00:00	INFO 127.0.0.1	update	La mise à jour vers la version 4.0.4 est achevée.
2021-11-01T16:04:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.09 seconds
2021-11-01T16:05:59+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.08 seconds
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: John Smith <gabrieldausque@gmail.com>
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Param=C3=A8tres_de_nouvel_utilisateur?=
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Mon, 1 Nov 2021 17:42:44 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <tPK3xjShXWTvRv7kbcx4PamSusq25AixluPRF9pkM@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: John Smith <gabrieldausque@gmail.com>
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Param=C3=A8tres_de_nouvel_utilisateur?=
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Mon, 1 Nov 2021 17:42:44 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <tuRLU11vxJ4mghLqRxqRp1yBKeNioQ0UvtB3xMcI@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-01T16:42:44+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-01T16:42:44+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2021-11-01T16:52:10+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Access\Exception\NotAllowed thrown with message "Vous n'avez pas les permissions requises pour accéder à ce contenu. Veuillez contacter un administrateur du site si vous pensez qu'il s'agit d'une erreur.". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(115): Joomla\Component\Media\Site\Dispatcher\Dispatcher->checkAccess()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#7 {main}
2021-11-01T16:54:07+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Access\Exception\NotAllowed thrown with message "Vous n'avez pas les permissions requises pour accéder à ce contenu. Veuillez contacter un administrateur du site si vous pensez qu'il s'agit d'une erreur.". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(115): Joomla\Component\Media\Site\Dispatcher\Dispatcher->checkAccess()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/mnt/c/workspac...')
#7 {main}
2021-11-02T07:06:06+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.10 seconds
2021-11-02T07:06:40+00:00	INFO 127.0.0.1	joomlafailure	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2021-11-02T07:06:40+00:00	WARNING 127.0.0.1	jerror	L'identifiant ne correspond pas au mot de passe, ou vous n'avez pas encore de compte.
2021-11-02T07:18:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T07:18:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T07:18:20+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.27 seconds
2021-11-02T07:18:21+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.12 seconds
2021-11-02T07:47:26+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.05 seconds
2021-11-02T07:47:27+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.03 seconds
2021-11-02T07:47:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.04 seconds
2021-11-02T07:47:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.03 seconds
2021-11-02T07:47:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.04 seconds
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: John Smith <gabrieldausque@gmail.com>
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Param=C3=A8tres_de_nouvel_utilisateur?=
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 2 Nov 2021 08:51:01 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <Ip1hjmIrzwq2WOS0MAieMOxv2HdsqZNWZqQGDbE@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sending with mail()
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Sendmail path: /usr/sbin/sendmail -t -i 
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Envelope sender: 
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: To: John Smith <gabrieldausque@gmail.com>
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Subject: =?utf-8?Q?Param=C3=A8tres_de_nouvel_utilisateur?=
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Headers: Date: Tue, 2 Nov 2021 08:51:01 +0100
From: Team A <gabrieldausque.pro@gmail.com>
Message-ID: <f13HMTCLPOqXU8trNdkSVY6K0KyP683N3R5PZKYfk@teama.myhost.domain>
MIME-Version: 1.0
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit


2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Result: false
2021-11-02T07:51:01+00:00	ERROR 127.0.0.1	mail	Error in Mail API: Could not instantiate mail function.
2021-11-02T07:51:01+00:00	WARNING 127.0.0.1	jerror	Could not instantiate mail function.
2021-11-02T08:23:10+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T08:23:10+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T08:29:25+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2021-11-02T09:20:27+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.17 Array (     [0] => 17 ) 
2021-11-02T09:36:41+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:38:10+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:38:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:39:55+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:39:57+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:41:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T09:47:12+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T10:09:43+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T10:39:22+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T10:40:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T10:58:40+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Administrator\Model\DateTime' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/FormController.php(644): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->validate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(47): Joomla\CMS\MVC\Controller\FormController->save()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->save()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-11-02T11:16:50+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot use object of type stdClass as array". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/FormController.php(644): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->validate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(47): Joomla\CMS\MVC\Controller\FormController->save()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->save()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#11 {main}
2021-11-02T14:03:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T14:03:33+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T14:04:04+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:04:15+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:04:31+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:04:58+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:07:24+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:07:38+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:08:18+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:08:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:09:34+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:10:50+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:11:24+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:12:37+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:12:59+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:13:05+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type TypeError thrown with message "Argument 1 passed to Joomla\CMS\User\UserFactory::loadUserById() must be of the type int, null given, called in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php on line 24". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(24): Joomla\CMS\User\UserFactory->loadUserById()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T14:14:06+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:14:31+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:14:55+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:19:26+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T14:19:40+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1066): Joomla\CMS\Router\Router->parse()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(822): Joomla\CMS\Application\CMSApplication->route()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(230): Joomla\CMS\Application\SiteApplication->route()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#4 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#5 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#6 {main}
2021-11-02T15:13:05+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T15:13:05+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-02T15:18:26+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Typed property TheLoneBlackSheep\Component\TeamA\Site\Model\Entities\Actions::$confirmationMessage must not be accessed before initialization". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/tmpl/onenews/default.php(16): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(25): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-02T16:09:39+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type ArgumentCountError thrown with message "Too few arguments to function Joomla\CMS\MVC\Model\AdminModel::delete(), 0 passed in /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php on line 56 and exactly 1 expected". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(56): Joomla\CMS\MVC\Model\AdminModel->delete()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->delete()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#10 {main}
2021-11-02T16:14:23+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot pass parameter 1 by reference". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->delete()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#9 {main}
2021-11-02T16:16:04+00:00	WARNING 127.0.0.1	jerror	Suppression non autorisée
2021-11-02T16:20:35+00:00	WARNING 127.0.0.1	jerror	Suppression non autorisée
2021-11-02T16:22:03+00:00	WARNING 127.0.0.1	jerror	Suppression non autorisée
2021-11-02T16:28:53+00:00	WARNING 127.0.0.1	jerror	Suppression non autorisée
2021-11-02T16:29:55+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Controller\Text' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->delete()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#8 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#9 {main}
2021-11-02T16:30:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(27): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T16:30:59+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(27): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-02T16:31:00+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class DateTime could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/Onenews/HtmlView.php(21): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\Onenews\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/OnenewsController.php(27): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\OnenewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T07:41:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T07:41:07+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T07:41:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2021-11-03T07:42:25+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Actions' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getActions()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(19): Joomla\CMS\MVC\View\AbstractView->get()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T07:44:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Actions' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getActions()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(21): Joomla\CMS\MVC\View\AbstractView->get()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T07:44:20+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Actions' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getActions()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(21): Joomla\CMS\MVC\View\AbstractView->get()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T07:45:01+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'TheLoneBlackSheep\Component\TeamA\Site\Model\Actions' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Site\Model\NewsModel->getActions()
#1 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/View/News/HtmlView.php(21): Joomla\CMS\MVC\View\AbstractView->get()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Site\View\News\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Controller/DisplayController.php(26): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Site\Controller\DisplayController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/components/com_teama/src/Dispatcher/Dispatcher.php(13): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Site\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(206): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(245): Joomla\CMS\Application\SiteApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\SiteApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T07:51:49+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.menu.1 Array (     [0] => 1 ) 
2021-11-03T07:51:52+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.menu.1 Array ( ) 
2021-11-03T07:59:19+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.1129 Array (     [0] => 1129 ) 
2021-11-03T07:59:45+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.1129 Array ( ) 
2021-11-03T08:00:03+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.1129 Array (     [0] => 1129 ) 
2021-11-03T08:00:20+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.1129 Array ( ) 
2021-11-03T08:33:58+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class Joomla\CMS\Menu\MenuItem could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/modules/mod_menu/mod_menu.php(27): require()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ModuleDispatcher.php(54): include('/data/workspace...')
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ModuleDispatcher.php(57): Joomla\CMS\Dispatcher\ModuleDispatcher::Joomla\CMS\Dispatcher\{closure}()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Helper/ModuleHelper.php(295): Joomla\CMS\Dispatcher\ModuleDispatcher->dispatch()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Helper/ModuleHelper.php(167): Joomla\CMS\Helper\ModuleHelper::renderRawModule()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Document/Renderer/Html/ModuleRenderer.php(102): Joomla\CMS\Helper\ModuleHelper::renderModule()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Document/Renderer/Html/ModulesRenderer.php(48): Joomla\CMS\Document\Renderer\Html\ModuleRenderer->render()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Document/HtmlDocument.php(589): Joomla\CMS\Document\Renderer\Html\ModulesRenderer->render()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Document/HtmlDocument.php(895): Joomla\CMS\Document\HtmlDocument->getBuffer()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Document/HtmlDocument.php(660): Joomla\CMS\Document\HtmlDocument->_renderTemplate()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(1036): Joomla\CMS\Document\HtmlDocument->render()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/SiteApplication.php(804): Joomla\CMS\Application\CMSApplication->render()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(284): Joomla\CMS\Application\SiteApplication->render()
#13 /data/workspaces/nodecms/PHP/joomla-teama/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#14 /data/workspaces/nodecms/PHP/joomla-teama/index.php(32): require_once('/data/workspace...')
#15 {main}
2021-11-03T08:43:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T08:43:03+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T09:28:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T09:28:32+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T09:35:58+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.14. Texte de la requête: ALTER TABLE #__teama_news ADD COLUMN tags LONGTEXT not null default '';.
2021-11-03T09:36:07+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getGroup() on null". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(643): Joomla\CMS\Layout\FileLayout->render()
#2 /data/workspaces/nodecms/PHP/joomla-teama/layouts/joomla/searchtools/default.php(94): Joomla\CMS\Layout\FileLayout->sublayout()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include('/data/workspace...')
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/LayoutHelper.php(73): Joomla\CMS\Layout\FileLayout->render()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/news/default.php(22): Joomla\CMS\Layout\LayoutHelper::render()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(30): Joomla\CMS\MVC\View\HtmlView->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T09:46:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot access protected property TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView::$filterForm". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(643): Joomla\CMS\Layout\FileLayout->render()
#2 /data/workspaces/nodecms/PHP/joomla-teama/layouts/joomla/searchtools/default.php(94): Joomla\CMS\Layout\FileLayout->sublayout()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include('/data/workspace...')
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/LayoutHelper.php(73): Joomla\CMS\Layout\FileLayout->render()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/news/default.php(22): Joomla\CMS\Layout\LayoutHelper::render()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(33): Joomla\CMS\MVC\View\HtmlView->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T09:46:43+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Cannot access protected property TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView::$filterForm". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(643): Joomla\CMS\Layout\FileLayout->render()
#2 /data/workspaces/nodecms/PHP/joomla-teama/layouts/joomla/searchtools/default.php(94): Joomla\CMS\Layout\FileLayout->sublayout()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/FileLayout.php(128): include('/data/workspace...')
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Layout/LayoutHelper.php(73): Joomla\CMS\Layout\FileLayout->render()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/news/default.php(22): Joomla\CMS\Layout\LayoutHelper::render()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/data/workspace...')
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(33): Joomla\CMS\MVC\View\HtmlView->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T10:16:04+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.15. Texte de la requête: alter table `#__teama_news` DROP COLUMN tags;.
2021-11-03T10:22:59+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: erreur SQL Can't DROP COLUMN `tags`; check that it exists
2021-11-03T10:22:59+00:00	WARNING 127.0.0.1	jerror	Installation de l'extension interrompue.
2021-11-03T10:24:22+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.16. Texte de la requête: alter table `#__teama_news` DROP COLUMN IF EXISTS tags;.
2021-11-03T10:24:22+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.16. Texte de la requête: create table if not exists `#__teama_tags` (     id int(11) NOT NULL AUTO_INCREM.
2021-11-03T10:24:22+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: erreur SQL Incorrect table definition; there can be only one auto column and it must be defined as a key
2021-11-03T10:24:22+00:00	WARNING 127.0.0.1	jerror	Installation de l'extension interrompue.
2021-11-03T10:25:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.16. Texte de la requête: alter table `#__teama_news` DROP COLUMN IF EXISTS tags;.
2021-11-03T10:25:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.16. Texte de la requête: create table if not exists `#__teama_tags` (     id int(11) NOT NULL AUTO_INCREM.
2021-11-03T10:25:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.16. Texte de la requête: create table if not exists `#__teama_news_tags` (     id int(11) NOT NULL AUTO_I.
2021-11-03T10:47:41+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:01:07+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:15:55+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.17. Texte de la requête: alter table `#__teama_tags` ADD UNIQUE KEY (`tag`);.
2021-11-03T11:24:15+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '\n(tags2),\n' at line 4". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TagsModel.php(34): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(103): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TagsModel->createIfNotExist()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/FormController.php(705): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->save()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\FormController->save()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T11:26:51+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Unknown column 'tags1' in 'field list'". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TagsModel.php(37): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(103): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TagsModel->createIfNotExist()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/FormController.php(705): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->save()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\FormController->save()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T11:27:56+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:28:21+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:30:06+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:30:29+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:30:53+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:35:32+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.19 Array (     [0] => 19 ) 
2021-11-03T11:35:34+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.19 Array ( ) 
2021-11-03T11:39:25+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T13:49:21+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.07 seconds
2021-11-03T14:06:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Unknown column 'b.news_id' in 'on clause'". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(160): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(86): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getTags()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(41): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getItem()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/FormBehaviorTrait.php(108): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->loadFormData()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(26): Joomla\CMS\MVC\View\AbstractView->get()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T14:07:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Unknown column 'b.news_id' in 'on clause'". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(160): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(86): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getTags()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(41): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getItem()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/FormBehaviorTrait.php(108): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->loadFormData()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(26): Joomla\CMS\MVC\View\AbstractView->get()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T14:08:53+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Unknown column 'b.news_id' in 'on clause'". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(160): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(86): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getTags()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(41): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getItem()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/FormBehaviorTrait.php(108): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->loadFormData()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(26): Joomla\CMS\MVC\View\AbstractView->get()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#16 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#17 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#18 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#19 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#20 {main}
2021-11-03T14:11:16+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:12:09+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:13:12+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:13:57+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:14:57+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:15:42+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:16:21+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Unknown column 'tags1' in 'where clause'". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(133): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(115): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->addTags()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/FormController.php(705): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->save()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\FormController->save()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T14:21:19+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:21:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class stdClass could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(86): implode()
#1 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(41): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getItem()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/FormBehaviorTrait.php(108): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->loadFormData()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(26): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T14:22:05+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Object of class stdClass could not be converted to string". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(87): implode()
#1 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(41): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getItem()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/FormBehaviorTrait.php(108): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->loadFormData()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/OnenewsModel.php(29): Joomla\CMS\MVC\Model\FormModel->loadForm()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\OnenewsModel->getForm()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(26): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T14:24:01+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:24:16+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.20 Array ( ) 
2021-11-03T14:24:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.18 Array (     [0] => 18 ) 
2021-11-03T14:24:29+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.18 Array (     [0] => 18 ) 
2021-11-03T14:26:31+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.18 Array (     [0] => 18 ) 
2021-11-03T14:28:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.18 Array (     [0] => 18 ) 
2021-11-03T14:28:52+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.18 Array ( ) 
2021-11-03T14:28:58+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.onenews.20 Array (     [0] => 20 ) 
2021-11-03T14:34:16+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.onenews.20 Array ( ) 
2021-11-03T14:35:05+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(31): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\OnenewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T14:35:10+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(31): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\OnenewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T14:36:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Mise en page default introuvable". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#1 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/Onenews/HtmlView.php(31): Joomla\CMS\MVC\View\HtmlView->display()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\Onenews\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/OnenewsController.php(22): Joomla\CMS\MVC\Controller\BaseController->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\OnenewsController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-03T15:07:48+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T15:07:48+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T15:08:52+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-11-03T15:44:29+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "__clone method called on non-object". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\ListModel->getEmptyStateQuery()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T15:54:17+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "__clone method called on non-object". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\ListModel->getEmptyStateQuery()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T15:56:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "__clone method called on non-object". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\ListModel->getEmptyStateQuery()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T15:57:39+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T15:59:11+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T16:01:28+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T16:02:25+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#5 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#10 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#15 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#17 {main}
2021-11-03T16:04:12+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/NewsModel.php(57): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): TheLoneBlackSheep\Component\TeamA\Administrator\Model\NewsModel->_getListCount()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#17 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#18 {main}
2021-11-03T16:05:12+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "Query was empty". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/BaseDatabaseModel.php(188): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/NewsModel.php(57): Joomla\CMS\MVC\Model\BaseDatabaseModel->_getListCount()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Model/ListModel.php(188): TheLoneBlackSheep\Component\TeamA\Administrator\Model\NewsModel->_getListCount()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): Joomla\CMS\MVC\Model\ListModel->getIsEmptyState()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(28): Joomla\CMS\MVC\View\AbstractView->get()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#8 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#12 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#13 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#14 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#15 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#16 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#17 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#18 {main}
2021-11-03T16:12:37+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T16:12:37+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-11-03T16:12:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.05 seconds
2021-11-03T16:12:50+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.03 seconds
2021-11-03T16:12:51+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.04 seconds
2021-11-03T16:15:42+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Class 'Route' not found". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/News/HtmlView.php(34): Joomla\CMS\MVC\View\HtmlView->display()
#3 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\News\HtmlView->display()
#4 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(13): Joomla\CMS\MVC\Controller\BaseController->display()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->display()
#6 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#14 {main}
2021-11-03T16:27:48+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\Database\Exception\PrepareStatementFailureException thrown with message "You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'WHERE id IN (20)' at line 1". Stack trace: #0 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/Mysqli/MysqliDriver.php(1048): Joomla\Database\Mysqli\MysqliStatement->__construct()
#1 /data/workspaces/nodecms/PHP/joomla-teama/libraries/vendor/joomla/database/src/DatabaseDriver.php(1900): Joomla\Database\Mysqli\MysqliDriver->prepareStatement()
#2 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/NewsModel.php(75): Joomla\Database\DatabaseDriver->setQuery()
#3 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/NewsController.php(23): TheLoneBlackSheep\Component\TeamA\Administrator\Model\NewsModel->delete()
#4 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\NewsController->delete()
#5 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#6 /data/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(12): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#8 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#9 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#10 /data/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#11 /data/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#12 /data/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/data/workspace...')
#13 {main}
2021-11-04T02:57:23+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 28.76 seconds
2021-11-04T02:57:23+00:00	WARNING 127.0.0.1	updater	Error opening url: https://update.joomla.org/core/list.xml for update site: Joomla! Core
