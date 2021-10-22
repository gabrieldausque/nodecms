<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

class OneNews {

  public $id = 0;
  public $title = '';
  public $body = '';
  public $author = 0;
  public $creation_date;
  public $modification_date;
  public $publication_date;
  public $current_stage = 0;
  public $publication_status = 0;
  public $last_modifier = 0;
  public $summary = '';
  public $header_media;

  public function __construct($isYouShallNotPass = false) {
    $this->creation_date = new \DateTime();
    $this->modification_date = new \DateTime();
    $this->publication_date = new \DateTime();
    $this->header_media = new class {
      public $image = '';
      public $alt = '';
      public $caption = '';
    };

    if($isYouShallNotPass){
      $this->title = Text::_('COM_TEAMA_FORBIDDEN');
      $this->header_media->image = '/media/com_teama/images/You_shall_not_pass.svg';
      $this->body = '<p>' . Text::_('COM_TEAMA_FORBIDDEN') . '</p>';
      $this->summary = Text::_('COM_TEAMA_FORBIDDEN');
    } else {
      $this->title = Text::_('COM_TEAMA_EMPTY');
      $this->header_media->image = '/media/com_teama/images/missing-document.png';
      $this->body = '<p>' . Text::_('COM_TEAMA_EMPTY') . '</p>';
      $this->summary = Text::_('COM_TEAMA_EMPTY');
    }


  }

}