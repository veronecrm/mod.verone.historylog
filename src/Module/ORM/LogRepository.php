<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\HistoryLog\ORM;

use CRM\ORM\Repository;
use CRM\ORM\Entity;
use CRM\Pagination\PaginationInterface;

class LogRepository extends Repository implements PaginationInterface
{
    public $dbTable = '#__history_log';

    /**
     * @see CRM\Pagination\PaginationInterface::paginationCount()
     */
    public function paginationCount()
    {
        $request = $this->request();

        $query = ['relatedWith = 0'];
        $binds = [];

        if($request->query->has('author') && trim($request->query->get('author')))
        {
            $query[] = 'authorId = :author';
            $binds[':author'] = $request->get('author');
        }
        if($request->query->has('module') && trim($request->query->get('module')))
        {
            $query[] = 'module = :module';
            $binds[':module'] = $request->get('module');
        }
        if($request->query->has('entityName') && trim($request->query->get('entityName')))
        {
            $query[] = 'entityName = :entityName';
            $binds[':entityName'] = $request->get('entityName');
        }
        if($request->query->has('entityId') && trim($request->query->get('entityId')))
        {
            $query[] = 'entityId = :entityId';
            $binds[':entityId'] = $request->get('entityId');
        }
        if($request->query->has('fromDate'))
        {
            $query[] = 'date >= :fromDate';
            $binds[':fromDate'] = strtotime($request->get('fromDate').' 00:00:00');
        }
        if($request->query->has('toDate'))
        {
            $query[] = 'date <= :toDate';
            $binds[':toDate'] = strtotime($request->get('toDate').' 23:00:00');
        }

        return $this->countAll(implode(' AND ', $query), $binds);
    }

    /**
     * @see CRM\Pagination\PaginationInterface::paginationGet()
     */
    public function paginationGet($start, $limit)
    {
        $request = $this->request();

        $query = ['relatedWith = 0'];
        $binds = [];

        if($request->query->has('author') && trim($request->query->get('author')))
        {
            $query[] = 'authorId = :author';
            $binds[':author'] = $request->get('author');
        }
        if($request->query->has('module') && trim($request->query->get('module')))
        {
            $query[] = 'module = :module';
            $binds[':module'] = $request->get('module');
        }
        if($request->query->has('entityName') && trim($request->query->get('entityName')))
        {
            $query[] = 'entityName = :entityName';
            $binds[':entityName'] = $request->get('entityName');
        }
        if($request->query->has('entityId') && trim($request->query->get('entityId')))
        {
            $query[] = 'entityId = :entityId';
            $binds[':entityId'] = $request->get('entityId');
        }
        if($request->query->has('fromDate'))
        {
            $query[] = 'date >= :fromDate';
            $binds[':fromDate'] = strtotime($request->get('fromDate').' 00:00:00');
        }
        if($request->query->has('toDate'))
        {
            $query[] = 'date <= :toDate';
            $binds[':toDate'] = strtotime($request->get('toDate').' 23:00:00');
        }

        $result = $this->selectQuery('SELECT * FROM #__history_log '.($query === [] ? '' : 'WHERE '.implode(' AND ', $query))." ORDER BY date DESC LIMIT $start, $limit", $binds);
        $result = $this->fillByRelations($result);

        return $result;
    }

    public function fillByRelations(array $data)
    {
        foreach($data as $key => $row)
        {
            $relations = $this->selectQuery(
                "SELECT *
                FROM #__history_log
                WHERE (
                    relatedWith = :relatedWith
                )
                ORDER BY date DESC", [ ':relatedWith' => $row->getId() ]);

            // Multi-level relations
            $relations = $this->fillByRelations($relations);

            $data[$key]->relations = $relations;
        }

        return $data;
    }
}
