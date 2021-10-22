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
