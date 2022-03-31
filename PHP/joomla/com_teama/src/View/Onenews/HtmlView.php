<?php

namespace TheLoneBlackSheep\Component\TeamA\Site\View\Onenews;

\defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
  protected $item;

  protected $actions;

  protected $form;

  public function display($tpl = NULL) {
    $this->actions = $this->get('Actions');
    $this->item = $this->get('Item');
    $this->form = $this->get('Form');
    parent::display($tpl); 
  }



}