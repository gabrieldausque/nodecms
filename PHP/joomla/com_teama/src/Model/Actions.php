<?php
/**
 * @package     TheLoneBlackSheep\Component\TeamA\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace TheLoneBlackSheep\Component\TeamA\Site\Model;

class Actions {

  public string $name;

  public string $link;

  /**
   * @param string $name
   * @param string $link
   */
  public function __construct(string $name, string $link) {
    $this->name = $name;
    $this->link = $link;
  }

}