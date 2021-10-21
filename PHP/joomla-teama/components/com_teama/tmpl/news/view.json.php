<?php
\defined('_JEXEC') or die;

use \Joomla\CMS\Response\JsonResponse;

echo new JsonResponse($this->news);
