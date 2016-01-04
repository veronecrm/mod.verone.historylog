<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\Controller;

use CRM\App\Controller\BaseController;
use CRM\Pagination\Paginator;

/**
 * @section mod.HistoryLog.History
 */
class History extends BaseController
{
    /**
     * @access core.read
     */
    public function indexAction($request)
    {
        $paginator = new Paginator($this->repo('Log'), $request->get('page'), $this->createUrl($this->request()->query->all()));

        $modules = $this->db()->builder()->select('module')->groupBy('module')->from('#__history_log')->all();
        $authors = $this->db()->builder()->select('authorName, authorId')->groupBy('authorName')->from('#__history_log')->all();

        return $this->render('', [
            'elements'    => $paginator->getElements(),
            'pagination'  => $paginator,
            'modules'     => $modules,
            'authors'     => $authors
        ]);
    }

    /**
     * @access core.read
     */
    public function entityHistoryAction($request)
    {
        $changes = $this->repo('Change')->findAllByLog($request->query->get('id'));
        $result  = [];

        $this->callPlugins('HistoryLog', 'retrieve', [
            $changes,
            $request->query->get('module'),
            $request->query->get('entity'),
            $request->query->get('entityId')
        ]);

        if($this->orm()->repository()->exists($request->query->get('entity'), $request->query->get('module')))
        {
            $fields = $this->repo($request->query->get('entity'), $request->query->get('module'))->getFieldsNames();

            foreach($changes as $change)
            {
                foreach($fields as $field => $name)
                {
                    if($change->getField() == $field)
                    {
                        $change->setField($name);
                    }
                }

                $result[] = $change->exportToArray();
            }
        }
        else
        {
            foreach($changes as $change)
            {
                $result[] = $change->exportToArray();
            }
        }

        $log = $this->repo('Log')->find($request->query->get('id'));

        return $this->responseAJAX([
            'data'   => [
                'changes' => $result,
                'type'    => $log->getType(),
                'log'     => $log->getLog()
            ],
            'status' => 'success'
        ]);
    }

    /**
     * @access core.read
     */
    public function historyAction($request)
    {
        $repo = $this->repo($request->query->get('entity'), $request->query->get('module'));

        $entity = $repo->find($request->query->get('id'));

        $page = (int) $request->query->get('page', 1);
        $page = $page <= 0 ? 1 : $page;

        $limit = 10;

        $summary = $this->openUserHistory($entity, $request->query->get('module'))->generateSummaryEdit(($page - 1) * $limit, $limit);
        $summary['perpage'] = $limit;

        foreach($summary['changes'] as $key => $val)
        {
            $summary['changes'][$key]->status = $this->t('changeStatusById'.$val->status);
            $summary['changes'][$key]->date   = $this->datetime($val->date);
        }

        return $this->responseAJAX([
            'data'   => $summary,
            'status' => 'success'
        ]);
    }
}
