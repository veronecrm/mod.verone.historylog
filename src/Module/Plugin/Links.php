<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\Plugin;

use CRM\App\Module\Plugin;

class Links extends Plugin
{
    public function dashboard()
    {
        if($this->acl('mod.HistoryLog.History', 'mod.HistoryLog')->isAllowed('core.read'))
        {
            return [
                [
                    'ordering' => 100,
                    'icon' => 'fa fa-book',
                    'icon-type' => 'class',
                    'name' => $this->t('modNameHistoryLog'),
                    'href' => $this->createUrl('HistoryLog', 'History')
                ]
            ];
        }
    }
}
