#
#<?php die('Forbidden.'); ?>
#Date: 2021-12-15 15:38:57 UTC
#Software: Joomla! 4.0.4 Stable [ Furaha ] 24-October-2021 19:25 GMT

#Fields: datetime	priority clientip	category	message
2021-12-15T15:38:57+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.09 seconds
2021-12-15T15:46:58+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T15:46:58+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T15:47:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.31 seconds
2021-12-15T15:47:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.06 seconds
2021-12-15T15:47:36+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.11 seconds
2021-12-15T15:48:07+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.07 seconds
2021-12-15T15:48:15+00:00	INFO 127.0.0.1	update	Mise à jour lancée par l'utilisateur admin_teama (461). L'ancienne version est &#x200E;4.0.4.
2021-12-15T15:48:37+00:00	INFO 127.0.0.1	update	Téléchargement du fichier de mise à jour depuis https://downloads.joomla.org/cms/joomla4/4-0-5/Joomla_4.0.5-Stable-Update_Package.zip.
2021-12-15T15:48:58+00:00	INFO 127.0.0.1	update	Téléchargement du fichier de mise à jour depuis https://github.com/joomla/joomla-cms/releases/download/4.0.5/Joomla_4.0.5-Stable-Update_Package.zip.
2021-12-15T15:49:02+00:00	INFO 127.0.0.1	update	Fichier Joomla_4.0.5-Stable-Update_Package.zip téléchargé.
2021-12-15T15:49:03+00:00	INFO 127.0.0.1	update	Lancement de l'installation de la nouvelle version.
2021-12-15T15:49:24+00:00	INFO 127.0.0.1	update	Conclusion de l'installation.
2021-12-15T15:49:25+00:00	INFO 127.0.0.1	update	Effacement des fichiers et dossiers à supprimer.
2021-12-15T15:49:28+00:00	INFO 127.0.0.1	update	Mise en ordre après installation.
2021-12-15T15:49:28+00:00	INFO 127.0.0.1	update	La mise à jour vers la version 4.0.5 est achevée.
2021-12-15T15:49:29+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.10 seconds
2021-12-15T15:50:27+00:00	WARNING 127.0.0.1	jerror	Erreur de connexion au serveur Failed to connect to s3-us-west-2.amazonaws.com port 443: Connection refused
2021-12-15T15:50:58+00:00	WARNING 127.0.0.1	jerror	Erreur de connexion au serveur Failed to connect to s3-us-west-2.amazonaws.com port 443: Connection refused
2021-12-15T15:54:00+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-12-15T15:57:11+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#10 {main}
2021-12-15T16:18:01+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:00:13+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T17:00:13+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T17:00:34+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:00:45+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:04:42+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.11 seconds
2021-12-15T17:05:32+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:08:19+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:09:23+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:24:08+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Affichage introuvable [nom, type, préfixe] : offshoot, html, Administrator". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(641): Joomla\CMS\MVC\Controller\BaseController->getView()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Controller/DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): TheLoneBlackSheep\Component\TeamA\Administrator\Controller\DisplayController->display()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#11 {main}
2021-12-15T17:24:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.28. Texte de la requête: drop table `#__teama_departments`;.
2021-12-15T17:24:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.28. Texte de la requête: drop table `#__teama_offshoots_departments`;.
2021-12-15T17:24:15+00:00	INFO 127.0.0.1	update	Requête lancée à partir du fichier 0.0.28. Texte de la requête: alter table `#__teama_offshoots` drop column `contact_id`;.
2021-12-15T17:24:35+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type RuntimeException thrown with message "Form::loadForm could not load file". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Model/TeamaModel.php(32): Joomla\CMS\MVC\Model\FormModel->loadForm()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/AbstractView.php(146): TheLoneBlackSheep\Component\TeamA\Administrator\Model\TeamAModel->getForm()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/TeamAViewOneItem.php(41): Joomla\CMS\MVC\View\AbstractView->get()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewOneItem->display()
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
2021-12-15T17:28:21+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.08 seconds
2021-12-15T17:29:31+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.1 Array (     [0] => 1 ) 
2021-12-15T17:59:51+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T17:59:51+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T18:00:17+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to undefined method stdClass::get()". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/offshoots/default.php(3): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/mnt/c/workspac...')
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/TeamAViewList.php(58): Joomla\CMS\MVC\View\HtmlView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2021-12-15T18:00:44+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to undefined method stdClass::_get()". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/offshoots/default.php(3): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/mnt/c/workspac...')
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/TeamAViewList.php(58): Joomla\CMS\MVC\View\HtmlView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2021-12-15T18:01:18+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to undefined method stdClass::__get()". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/tmpl/offshoots/default.php(3): include()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(429): include('/mnt/c/workspac...')
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/View/HtmlView.php(218): Joomla\CMS\MVC\View\HtmlView->loadTemplate()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/View/TeamAViewList.php(58): Joomla\CMS\MVC\View\HtmlView->display()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(692): TheLoneBlackSheep\Component\TeamA\Administrator\View\TeamAViewList->display()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\BaseController->display()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#9 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#10 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#11 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#12 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#13 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#14 {main}
2021-12-15T20:25:01+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T20:25:01+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2021-12-15T20:28:21+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2021-12-15T20:28:33+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2021-12-15T20:28:37+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.2 Array ( ) 
2022-01-03T17:29:39+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-03T17:29:39+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-03T17:29:39+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.65 seconds
2022-01-03T17:29:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-03T17:29:41+00:00	WARNING 127.0.0.1	assets	No asset found for com_modules.module.90, falling back to com_modules
2022-01-03T17:30:26+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.48 seconds
2022-01-03T17:30:28+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.51 seconds
2022-01-03T17:30:31+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.38 seconds
2022-01-03T17:30:31+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.39 seconds
2022-01-03T17:30:33+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component Update Site" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.59 seconds
2022-01-03T17:31:07+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Error thrown with message "Call to a member function getTable() on bool". Stack trace: #0 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/MVC/Controller/BaseController.php(730): Joomla\CMS\MVC\Controller\FormController->edit()
#1 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Dispatcher/ComponentDispatcher.php(146): Joomla\CMS\MVC\Controller\BaseController->execute()
#2 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/components/com_teama/src/Dispatcher/Dispatcher.php(14): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#3 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Component/ComponentHelper.php(389): TheLoneBlackSheep\Component\TeamA\Administrator\Dispatcher\Dispatcher->dispatch()
#4 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent()
#5 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#6 /mnt/c/workspaces/nodecms/PHP/joomla-teama/libraries/src/Application/CMSApplication.php(278): Joomla\CMS\Application\AdministratorApplication->doExecute()
#7 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/includes/app.php(63): Joomla\CMS\Application\CMSApplication->execute()
#8 /mnt/c/workspaces/nodecms/PHP/joomla-teama/administrator/index.php(32): require_once('/mnt/c/workspac...')
#9 {main}
2022-01-03T17:37:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2022-01-03T17:37:39+00:00	INFO 127.0.0.1	controller	Holding edit ID com_teama.edit.offshoot.2 Array (     [0] => 2 ) 
2022-01-03T17:37:42+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_teama.edit.offshoot.2 Array ( ) 
