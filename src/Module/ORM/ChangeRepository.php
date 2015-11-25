<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\ORM;

use CRM\ORM\Repository;

class ChangeRepository extends Repository
{
  public $dbTable = '#__history_change';

  public function findAllByLog($id)
  {
    return $this->findAll('`change` = :change', [ ':change' => $id ]);
  }
}
