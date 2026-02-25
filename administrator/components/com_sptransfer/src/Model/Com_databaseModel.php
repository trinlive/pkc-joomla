<?php

/*
 * Copyright (C) 2017 KAINOTOMO PH LTD <info@kainotomo.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Joomla\Component\Sptransfer\Administrator\Model;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

/**
 * Description of ComDatabase
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_databaseModel extends BaseDatabaseModel {

        protected $jAp;
        protected $tableLog;
        protected $destination_db;
        protected $destination_query;
        protected $destination_table;
        protected $table_name;
        protected $source_db;
        protected $source_query;
        protected $user;
        protected $params;
        protected $task;
        protected $factory;
        protected $id;
        protected $batch;
        protected $status;

        function __construct($config = array()) {
                parent::__construct($config);
                $this->jAp = Factory::getApplication();
                $this->tableLog = $this->getTable('Log');
                $this->destination_db = DatabaseHelper::getDestinationDbo();
                //****************************************************************************
                //This is to overcome issue: https://github.com/joomla/joomla-cms/issues/18993
                //Remove below two lines when issue is fixed
                $this->destination_db->setQuery("set @@sql_mode = ''");
                $this->destination_db->execute();
                //****************************************************************************
                $this->destination_query = $this->destination_db->getQuery(true);
                $this->source_db = DatabaseHelper::getSourceDbo();
                $this->source_query = $this->source_db->getQuery(true);
                $this->user = Factory::getUser();
                $this->params = ComponentHelper::getParams('com_sptransfer');
                $this->batch = $this->params->get('batch', 100);
                $this->task = $config['task'];
                $this->status = $config['status'];
        }

        public function content($pks = null, $prefix, $name) {
                // Initialize
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;
                $task = $this->task;
                $params = $this->params;

                // Load items
                $query = 'SELECT source_id
            FROM #__sptransfer_log
            WHERE tables_id = ' . (int) $task->id . ' AND state >= 2
            ORDER BY id ASC';
                $destination_db->setQuery($query);
                $excludes = $destination_db->loadColumn();

                //Find ids
                if (is_null($pks[0])) {
                        $pks = [];
                        $query = 'SELECT COUNT(*)' .
                                ' FROM #__' . $name;
                        $source_db->setQuery($query);
                        try {
                                $source_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit($exc->getMessage());
                        }
                        $total_items = $source_db->loadResult();
                        for ($index = 0; $index < $total_items; $index++) {
                                $pks[$index] = $index;
                        }
                }
                
                //percentage monitoring
                $session = Factory::getSession();
                $percentage = $session->get('percentage', null, 'SPTransfer');
                if ($percentage) {
                        if ($percentage['total'] <= $percentage['index']) {
                                $session->clear('percentage', 'SPTransfer');
                                $percentage = $session->set('percentage', ['total' => count($pks), 'index' => 0, 'percentage' => 0], 'SPTransfer');
                        }
                        $percentage = $session->get('percentage', null, 'SPTransfer');
                } else {
                        $percentage = $session->set('percentage', ['total' => count($pks), 'index' => 0, 'percentage' => 0], 'SPTransfer');
                        $percentage = $session->get('percentage', null, 'SPTransfer');
                }
                
                // Loop to save items
                foreach ($pks as $pk) {

                        //Load data from source
                        $exclude = array_search($pk, $excludes);
                        if ($exclude !== false) {
                                unset($excludes[$exclude]);
                                continue;
                        }

                        $query = 'SELECT * FROM #__' . $name .
                                ' LIMIT ' . $pk . ', 1';
                        $source_db->setQuery($query);
                        try {
                                $source_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit($exc->getMessage());
                        }
                        $item = $source_db->loadAssoc();

                        if (empty($item)) {
                                continue;
                        }

                        //status pending
                        $this->batch -= 1;
                        if ($this->batch < 0) {
                                return;
                        }

                        //log            
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => $task->id, "source_id" => $pk));
                        $tableLog->created = null;
                        $tableLog->note = "";
                        $tableLog->source_id = $pk;
                        $tableLog->destination_id = $pk;
                        $tableLog->state = 1;
                        $tableLog->tables_id = $task->id;

                        //Build query
                        $query = "INSERT INTO #__" . $name . " (";
                        if ($params->get("new_ids", 0) == 2) {
                                $query = "REPLACE INTO #__" . $name . " (";
                        }
                        $columnNames = Array();
                        $values = Array();
                        foreach ($item as $column => $value) {
                                if (($column != 'sp_id') && (!is_null($value))) {
                                        $columnNames[] = $destination_db->quoteName($column);
                                        $temp1 = implode(',', $columnNames);
                                        $values[] = $destination_db->quote($value);
                                        $temp2 = implode(',', $values);
                                }
                        }
                        $query .= $temp1 . ") VALUES (" . $temp2 . ")";

                        // Create record
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit($exc->getMessage());
                                $tableLog->note = $destination_db->getErrorMsg();
                                $tableLog->store();
                                continue;
                        }

                        //Log
                        $tableLog->state = 4;
                        $tableLog->store();
                        $percentage['index'] += 1;
                        $percentage['percentage'] = round($percentage['index'] / $percentage['total'] * 100);
                        $session->set('percentage', $percentage, 'SPTransfer');
                } //Main loop end
                //fix auto increment
                $this->destination_db->setQuery(
                        "ALTER TABLE `#__" . $name . "` AUTO_INCREMENT = 1;"
                );
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit($exc->getMessage());
                }

                //status completed
                $this->status = 'completed';
                
        }

        public function setTable($prefix, $name) {

                //Exit if empty table
                $source_table_name = $prefix . '_' . $name;

                // Init
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;

                //Define destination table name
                $destination_table_name = $destination_db->getPrefix() . $name;

                // Get tables descriptions
                $query = 'SHOW CREATE TABLE ' . $source_table_name;

                $source_db->setQuery($query);
                try {
                        $source_db->execute();
                } catch (\RuntimeException $exc) {
                        exit($exc->getMessage());
                }
                $source_table_desc = $source_db->loadObject();

                $query = 'describe ' . $destination_table_name;
                $destination_db->setQuery($query);
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        //Create table
                        $query = $source_table_desc->{'Create Table'};
                        $query = str_replace('CREATE TABLE `' . $source_table_name, 'CREATE TABLE `' . $destination_table_name, $query);
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc_inner) {
                                exit($exc_inner->getMessage());
                        }
                        $query = 'describe ' . $destination_table_name;
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc_inner) {
                                exit($exc_inner->getMessage());
                        }
                }

                return;
        }

        public function getResult() {

                $result = Array();
                $result['status'] = $this->status;
                $result['message'] = $this->task->extension_name . ' - ' . $this->task->name;

                return $result;
        }

}
