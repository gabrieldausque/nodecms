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
