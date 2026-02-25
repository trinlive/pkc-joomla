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

defined('_JEXEC') or die;

use Joomla\CMS\Cache\Cache;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Session\Session;
use Joomla\CMS\String\PunycodeHelper;
use Joomla\Utilities\ArrayHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;

class CategoryModel extends \Joomla\Component\Categories\Administrator\Model\CategoryModel
{

        public function __construct($config = array(), MVCFactoryInterface $factory = null)
        {
                parent::__construct($config, $factory);
        }

        public function getTable($type = 'Category', $prefix = 'Administrator', $config = array())
        {
                if (empty($config['dbo'])) {
                        $config['dbo'] = $this->_db;
                }
                $table = new \Joomla\Component\Categories\Administrator\Table\CategoryTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }
}

/**
 * Description of ComModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class ComModel extends BaseDatabaseModel
{

        protected $jAp;
        protected $tableLog;
        protected $destination_db;
        protected $destination_query;
        protected $destination_table;
        protected $destination_model;
        protected $table_name;
        protected $source_db;
        protected $source_query;
        protected $source_model;
        protected $user;
        protected $params;
        protected $task;
        protected $id;
        protected $ordering;
        protected $alias;
        protected $batch;
        protected $status;

        function __construct($config = array())
        {
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
                $this->alias = 'alias';
                $this->id = 'id';
                $this->ordering = ' ORDER BY id ASC';
                $this->batch = $this->params->get('batch', 100);
                $this->task = $config['task'];
                $this->status = $config['status'];
                $this->task->state = 2;
        }

        public function categories($ids = null)
        {
                $this->params->set('duplicate_alias', 0);

                $this->destination_model = new CategoryModel(array('dbo' => $this->destination_db));
                $this->source_model = new CategoryModel(array('dbo' => $this->source_db));

                $this->task->state = 2; //state for success

                $this->ordering = ' ORDER BY level ASC, lft ASC';
                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__categories
            WHERE extension LIKE "' . $this->task->extension_name . '"';

                $this->items_copy($ids);
        }

        public function categories_fix($ids = null)
        {
                $this->destination_model = new CategoryModel(array('dbo' => $this->destination_db));
                $this->source_model = new CategoryModel(array('dbo' => $this->source_db));

                $this->task->state = 4; //state for success

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__categories
            WHERE extension LIKE "' . $this->task->extension_name . '"';

                $this->items_fix($ids);
        }

        public function items_copy($pks = null)
        {
                // Initialize
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;
                $source_model = $this->source_model;
                $destination_model = $this->destination_model;
                $this->destination_table = $destination_model->getTable();
                $destination_table = $this->destination_table;
                $params = $this->params;
                $task = $this->task;
                $table_name = $this->task->name;
                $id = $this->id;

                // Load pks
                $query = 'SELECT source_id
            FROM #__sptransfer_log
            WHERE tables_id = ' . (int) $task->id . ' AND state >= 2
            ORDER BY id ASC';
                $destination_db->setQuery($query);
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                }
                $excludes = $destination_db->loadColumn();

                //Find ids
                if (is_null($pks[0])) {
                        $existing_id = true;
                        $query = $this->task->query;
                        $query .= $this->ordering;
                        $source_db->setQuery($query);
                        try {
                                $source_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                        $pks = $source_db->loadColumn();
                } else {
                        $existing_id = false;
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

                // Loop to save pks
                foreach ($pks as $pk) {

                        //Load data from source
                        $exclude = array_search($pk, $excludes);
                        if ($exclude !== false) {
                                unset($excludes[$exclude]);
                                continue;
                        }

                        // Load object
                        Factory::$database = $this->source_db;
                        try {
                                $source_data = ArrayHelper::fromObject($source_model->getItem($pk));
                                $source_data['sp_id'] = 0;
                                $destination_model->setState($destination_model->getName() . '.id', 0);
                        } catch (\RuntimeException $exc) {
                                exit($exc->getMessage());
                        }
                        Factory::$database = $this->destination_db;

                        if (empty($source_data[$id]) || ($source_data[$id] == 0)) {
                                if ($existing_id) {
                                        exit($source_db->getErrorMsg());
                                } else {
                                        continue;
                                }
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
                        $tableLog->task = $task;
                        $tableLog->store();

                        //rules
                        if (array_key_exists('asset_id', $source_data)) {
                                $source_data['rules'] = $this->getRules($source_data['asset_id']);
                        }
                        //tags  
                        unset($source_data['tagsHelper']);
                        if (array_key_exists('tags', $source_data)) {
                                $source_data['tags'] = $this->convertTags($source_data['tags']['tags']);
                        }

                        $tableLog->load(array("tables_id" => $task->id, "source_id" => $pk));

                        //setup replace options
                        $query = $destination_db->getQuery(true);
                        $query->select($destination_db->qn($id))
                                ->from('#__' . $table_name)
                                ->where($destination_db->qn($id) . '=' . $destination_db->q($pk));
                        $destination_db->setQuery($query);
                        try {
                                $result = $destination_db->loadResult();
                        } catch (\Exception $exc) {
                                echo $exc->getTraceAsString();
                                $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                $tableLog->store();
                                continue;
                        }
                        $new_ids = (int) $params->get("new_ids", 0);
                        if (!empty($result)) { //if existing record decide how to proceed
                                switch ($new_ids) {
                                        case 0: //Do not transfer. Skip items
                                                $tableLog->note = Text::_('COM_SPTRANSFER_EXISTING_ITEM');
                                                $tableLog->store();
                                                continue;
                                        case 1: //Transfer items and save with new id
                                                $source_data[$id] = 0;
                                                break;
                                        case 2: //Replace existing items
                                                $destination_model->getItem($pk);
                                                break;
                                        default:
                                                exit(Text::printf('JERROR_PARSING_LANGUAGE_FILE', 255));
                                                continue;
                                }
                        } else { //not existing record
                                switch ($new_ids) {
                                        case 0 || 2:
                                                //Do not transfer. Skip items
                                                //Replace existing items
                                                $source_data['sp_id'] = $source_data[$id];
                                                $destination_model->set('sp_id', $source_data[$id]);
                                                $source_data[$id] = 0;
                                                break;
                                        case 1: //Transfer items and save with new id
                                                $source_data[$id] = 0;
                                                break;
                                        default:
                                                exit(Text::printf('JERROR_PARSING_LANGUAGE_FILE', 255));
                                                continue;
                                }
                        }

                        //Various assignments
                        //alias
                        if (array_key_exists('alias', $source_data)) {
                                //$source_data['password2'] = $source_data['password'];
                        }
                        //password
                        if (array_key_exists('password', $source_data)) {
                                $source_data['password2'] = $source_data['password'];
                        }
                        //punycode urls
                        if (isset($source_data['urls']) && is_array($source_data['urls'])) {
                                foreach ($source_data['urls'] as $i => $url) {
                                        $source_data['urls'][$i] = !empty($url) ? PunycodeHelper::fromPunycode($url) : $url;
                                }
                        }

                        //save with model                             
                        $destination_model->getState($destination_model->getName() . '.id');
                        try {
                                $result = $destination_model->save($source_data);
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = $exc->getMessage();
                                $tableLog->store();
                                //exit($exc->getMessage());
                                continue;
                        }

                        //check for errors
                        if ($result === false) {
                                if ($params->get("duplicate_alias", 0) == 0) {

                                        if (isset($source_data['alias'])) {
                                                $source_data['alias'] .= '-sp-' . rand(100, 999);
                                        }
                                        else if (isset($source_data['menutype'])) {
                                                $source_data['menutype'] .= '-sp-' . rand(100, 999);
                                        }
                                        else if (isset($source_data['title'])) {
                                                $source_data['title'] .= '-sp-' . rand(100, 999);
                                        }

                                        try {
                                                $result = $destination_model->save($source_data);
                                        } catch (\RuntimeException $exc) {
                                                $tableLog->note = $exc->getMessage();
                                                $tableLog->store();
                                                //exit($exc->getMessage());
                                                continue;
                                        }
                                        if ($result === false) {
                                                $tableLog->note = $destination_model->getError();
                                                $tableLog->store();
                                                continue;
                                        }
                                } else {
                                        $tableLog->note = $destination_model->getError();
                                        $tableLog->store();
                                        continue;
                                }
                        }

                        //check if new id
                        $tableLog->destination_id = (int) $destination_model->getState($destination_model->getName() . '.id');
                        if ($tableLog->source_id != $tableLog->destination_id) {
                                $source_data['id'] = $tableLog->destination_id;
                                $tableLog->note = Text::_('COM_SPTRANSFER_MSG_ID_CHANGED');
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_content_content':
                                        $this->com_content_content();
                                        break;
                                case 'com_banners_banners':
                                        $this->com_banners_banners();
                                        break;
                                case 'com_modules_modules':
                                        $this->com_modules_modules();
                                        break;
                                case 'com_fields_fields':
                                        $this->com_fields_fields();
                                        break;
                        }

                        //Log
                        $tableLog->state = $this->task->state; //state for success;
                        $tableLog->store();
                        $percentage['index'] += 1;
                        $percentage['percentage'] = round($percentage['index'] / $percentage['total'] * 100);
                        $session->set('percentage', $percentage, 'SPTransfer');
                } //Main loop end


                //status completed
                $this->status = 'completed';
        }

        public function items_new($pks = null)
        {
                // Initialize
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;
                $source_model = $this->source_model;
                $destination_model = $this->destination_model;
                $this->destination_table = $destination_model->getTable();
                $destination_table = $this->destination_table;
                $params = $this->params;
                $task = $this->task;
                $table_name = $this->task->name;
                $id = $this->id;

                // Load pks
                $query = 'SELECT source_id
            FROM #__sptransfer_log
            WHERE tables_id = ' . (int) $task->id . ' AND state >= 2
            ORDER BY id ASC';
                $destination_db->setQuery($query);
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                }
                $excludes = $destination_db->loadColumn();

                //Find ids
                if (is_null($pks[0])) {
                        $existing_id = true;
                        $query = $this->task->query;
                        $query .= $this->ordering;
                        $source_db->setQuery($query);
                        try {
                                $source_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                        $pks = $source_db->loadColumn();
                } else {
                        $existing_id = false;
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

                // Loop to save pks
                foreach ($pks as $pk) {
                        //Load data from source
                        $exclude = array_search($pk, $excludes);
                        if ($exclude !== false) {
                                unset($excludes[$exclude]);
                                continue;
                        }

                        // Load object
                        Factory::$database = $this->source_db;
                        try {
                                $source_data = ArrayHelper::fromObject($source_model->getItem($pk));
                        } catch (\RuntimeException $exc) {
                                exit($exc->getMessage());
                        }
                        Factory::$database = $this->destination_db;

                        if (empty($source_data[$id]) || ($source_data[$id] == 0)) {
                                if ($existing_id) {
                                        exit($source_db->getErrorMsg());
                                } else {
                                        continue;
                                }
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
                        $tableLog->store();

                        //rules
                        if (array_key_exists('asset_id', $source_data)) {
                                $source_data['rules'] = $this->getRules($source_data['asset_id']);
                        }
                        //tags  
                        unset($source_data['tagsHelper']);
                        if (array_key_exists('tags', $source_data)) {
                                $source_data['tags'] = $this->convertTags($source_data['tags']['tags']);
                        }

                        $tableLog->load(array("tables_id" => $task->id, "source_id" => $pk));

                        // Create record
                        $destination_db->setQuery(
                                "INSERT INTO #__" . $table_name .
                                        " (" . $id . ")" .
                                        " VALUES (" . $destination_db->quote($pk) . ")"
                        );

                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                if ($params->get("new_ids", 0) == 1) {
                                        $destination_db->setQuery(
                                                "INSERT INTO #__" . $table_name .
                                                        " (" . $id . ")" .
                                                        " VALUES (" . $destination_db->quote(0) . ")"
                                        );
                                        try {
                                                $destination_db->execute();
                                        } catch (\RuntimeException $exc2) {
                                                $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                                $tableLog->store();
                                                exit($exc2->getMessage());
                                                continue;
                                        }
                                        $destination_db->setQuery(
                                                "SELECT id FROM #__" . $table_name .
                                                        " ORDER BY id DESC "
                                        );
                                        $destination_db->execute();
                                        $tableLog->destination_id = $destination_db->loadResult();
                                        $message = '<p>' . Text::sprintf('COM_SPTRANSFER_MSG_NEW_IDS', $pk, $tableLog->destination_id) . '</p>';
                                        $pk = $tableLog->destination_id;
                                        $source_data['id'] = $tableLog->destination_id;
                                        $tableLog->note = $message;
                                } elseif ($params->get("new_ids", 0) == 0) {
                                        $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                        $tableLog->store();
                                        //exit('<b>Error Code:</b> ' . $exc->getCode() . '<br/><b>Error Message:</b> ' . $exc->getMessage());
                                        continue;
                                }
                        }

                        // Reset                        
                        $destination_table->reset();

                        //Tags                        
                        if ((!empty($source_data['tags']) && $source_data['tags'][0] != '')) {
                                $destination_table->newTags = $source_data['tags'];
                        }

                        //Replace existing pk
                        if ($params->get("new_ids", 0) == 2) {
                                $destination_table->load($tableLog->source_id);
                        }

                        // Bind                        
                        $tagsHelper = $destination_table->tagsHelper;
                        if (!$destination_table->bind($source_data)) {
                                // delete record
                                $destination_db->setQuery(
                                        "DELETE FROM #__" . $table_name .
                                                " WHERE " . $id . " = " . $destination_db->quote($pk)
                                );
                                try {
                                        $destination_db->execute();
                                } catch (\RuntimeException $exc) {
                                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                                }

                                $tableLog->note = $destination_db->getErrorMsg();
                                $tableLog->store();
                                exit($destination_db->getErrorMsg());
                                continue;
                        }
                        $destination_table->tagsHelper = $tagsHelper;

                        // Store
                        try {
                                $destination_table->store();
                        } catch (\RuntimeException $e) {                                
                                //Factory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
                                $destination_table->setError($e->getMessage());
                                //do nothing
                        }
                        if ($destination_table->getError()) {
                                if ($params->get("duplicate_alias", 0)) {
                                        $destination_table->{$this->alias} .= '-sp-' . rand(100, 999);
                                        if (!$destination_table->store()) {
                                                // delete record
                                                $destination_db->setQuery(
                                                        "DELETE FROM #__" . $table_name .
                                                                " WHERE " . $id . " = " . $destination_db->quote($pk)
                                                );
                                                try {
                                                        $destination_db->execute();
                                                } catch (\RuntimeException $exc) {
                                                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                                                }
                                                $tableLog->note = $destination_db->getErrorMsg();
                                                $tableLog->store();
                                                exit($destination_db->getErrorMsg());
                                                continue;
                                        }
                                        $tableLog->note = '<p>' . Text::sprintf('COM_SPTRANSFER_MSG_DUPLICATE_ALIAS', $pk, $destination_table->{$this->alias}) . '</p>';
                                } else {
                                        // delete record
                                        $destination_db->setQuery(
                                                "DELETE FROM #__" . $table_name .
                                                        " WHERE " . $id . " = " . $destination_db->quote($pk)
                                        );
                                        try {
                                                $destination_db->execute();
                                        } catch (\RuntimeException $exc) {
                                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                                        }
                                        $tableLog->note = $destination_db->getErrorMsg();
                                        $tableLog->store();
                                        exit($destination_db->getErrorMsg());
                                        continue;
                                }
                        }

                        //save with model            
                        $destination_object = $destination_model->getItem($destination_table->id);
                        unset($destination_object->{$this->alias});
                        $destination_data = ArrayHelper::fromObject($destination_object);

                        //Various assignments
                        //unsert tagsHelper
                        unset($destination_data['tagsHelper']);
                        //password
                        if (array_key_exists('password', $destination_data)) {
                                $destination_data['password2'] = $destination_data['password'];
                        }
                        //tags            
                        if (array_key_exists('tags', $destination_data)) {
                                $destination_data['tags'] = explode(',', $destination_data['tags']['tags']);
                        }
                        //images & urls
                        $destination_data['images'] = $source_data['images'];
                        $destination_data['urls'] = $source_data['urls'];
                        //user profile
                        if (array_key_exists('profile', $destination_data)) {
                                $destination_data['profile'] = $source_data['profile'];
                        }

                        $destination_model->getState($destination_model->getName() . '.id');
                        try {
                                if ($params->get("save_with_model", 1)) {
                                        $destination_model->save($destination_data);
                                }
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = $exc->getMessage();
                                $tableLog->store();
                                exit($exc->getMessage());
                                continue;
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_content_content':
                                        $this->com_content_content();
                                        break;
                                case 'com_banners_banners':
                                        $this->com_banners_banners();
                                        break;
                                case 'com_modules_modules':
                                        $this->com_modules_modules();
                                        break;
                                case 'com_fields_fields':
                                        $this->com_fields_fields();
                                        break;
                        }

                        //Log
                        $tableLog->state = $this->task->state; //state for success;
                        $tableLog->store();
                        $percentage['index'] += 1;
                        $percentage['percentage'] = round($percentage['index'] / $percentage['total'] * 100);
                        $session->set('percentage', $percentage, 'SPTransfer');
                } //Main loop end
                //status completed
                $this->status = 'completed';
        }

        public function items_fix($pks = null)
        {
                // Initialize
                //$factory = $this->factory;
                //$source = $this->source;
                //$jAp = $this->jAp;
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                //$destination_query = $this->destination_query;
                //$source_query = $this->source_query;
                $destination_model = $this->destination_model;
                $this->destination_table = $destination_model->getTable();
                $source_db = $this->source_db;
                //$source_query = $this->source_query;
                //$destination_table = $this->destination_table;
                //$user = $this->user;
                //$params = $this->params;
                $task = $this->task;
                $id = $this->id;

                // Load items
                $query = 'SELECT destination_id
            FROM #__sptransfer_log
            WHERE tables_id = ' . (int) $task->id . ' AND ( state = 2 OR state = 3 )';
                $query .= ' ORDER BY id ASC';
                $destination_db->setQuery($query);
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                }
                $excludes = $destination_db->loadColumn();

                //Find ids
                if (is_null($pks[0])) {
                        $existing_id = true;
                        $query = $this->task->query;
                        $query .= $this->ordering;
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                        $pks = $destination_db->loadColumn();
                } else {
                        $existing_id = false;
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

                // Loop to save pks
                foreach ($pks as $pk) {

                        //Load data from source
                        if (!$existing_id) {
                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $task->id, "source_id" => $pk));
                                $pk = $tableLog->destination_id;
                        }

                        $exclude = array_search($pk, $excludes);
                        if ($exclude === false) {
                                continue;
                        } else {
                                unset($excludes[$exclude]);
                        }

                        //save with model
                        $destination_data = ArrayHelper::fromObject($destination_model->getItem($pk));

                        if (empty($destination_data[$id]) || ($destination_data[$id] == 0)) {
                                if ($existing_id) {
                                        exit($source_db->getErrorMsg());
                                } else {
                                        continue;
                                }
                        }

                        //status pending
                        $this->batch -= 1;
                        if ($this->batch < 0) {
                                return;
                        }

                        //tags      
                        unset($destination_data['tagsHelper']);
                        if (array_key_exists('tags', $destination_data)) {
                                unset($destination_data['tags']);
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_users_viewlevels':
                                        $destination_data = $this->com_users_viewlevels_fix($destination_data);
                                        break;
                                case 'com_users_users':
                                        $destination_data = $this->com_users_users_fix($destination_data);
                                        break;
                                case 'com_banners_banners':
                                        $destination_data = $this->com_banners_banners_fix($destination_data);
                                        break;
                                case 'com_menus_menu':
                                        $destination_data = $this->com_menus_menu_fix($destination_data);
                                        break;
                                case 'com_modules_modules':
                                        $this->com_modules_modules_fix($destination_data);
                                        break;
                        }

                        // Set destination_id
                        //created_by
                        if ($destination_data['created_by'] > 0) {
                                $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['created_by']));
                                if ($tableLog->source_id != $tableLog->destination_id) {
                                        $destination_data['created_by'] = $tableLog->destination_id;
                                }
                        }
                        //created_user_id
                        if ($destination_data['created_user_id'] > 0) {
                                $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['created_user_id']));
                                if ($tableLog->source_id != $tableLog->destination_id) {
                                        $destination_data['created_user_id'] = $tableLog->destination_id;
                                }
                        }
                        //user_id
                        if ($destination_data['user_id'] > 0) {
                                $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['user_id']));
                                if ($tableLog->source_id != $tableLog->destination_id) {
                                        $destination_data['user_id'] = $tableLog->destination_id;
                                }
                        }

                        //modified_by
                        /*
                          if ($destination_data['modified_by'] > 0) {
                          $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['modified_by']));
                          if ($tableLog->source_id != $tableLog->destination_id) {
                          $destination_data['modified_by'] = $tableLog->destination_id;
                          }
                          }
                         * 
                         */

                        //catid
                        if ($destination_data['catid'] > 1) {

                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $this->task->category, "source_id" => $destination_data['catid']));
                                if ($tableLog->source_id == $tableLog->destination_id) {
                                        $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                                        $tableLog->state = 4;
                                        $tableLog->store();
                                        continue;
                                }
                                $destination_data['catid'] = $tableLog->destination_id;
                        } /* else {
                          $tableLog->reset();
                          $tableLog->id = null;
                          $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                          $tableLog->state = 4;
                          $tableLog->store();
                          continue;
                          }
                         * 
                         */

                        //parent_id
                        if ($destination_data['parent_id'] > 1) {
                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $task->id, "source_id" => $destination_data['parent_id']));
                                $destination_data['parent_id'] = $tableLog->destination_id;
                        }

                        //Password
                        if (array_key_exists('password', $destination_data)) {
                                $destination_data['password2'] = $destination_data['password'];
                        }

                        //log            
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                        $tableLog->created = null;
                        $tableLog->state = 3;
                        $tableLog->tables_id = $task->id;

                        //save model
                        try {
                                $destination_model->save($destination_data);
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = $exc->getMessage();
                                $tableLog->store();
                                exit($exc->getMessage());
                                continue;
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_users_users':
                                        $this->com_users_users_fix_new($destination_data);
                                        break;
                        }

                        //Log
                        $tableLog->state = 4;
                        $tableLog->store();
                        $percentage['index'] += 1;
                        $percentage['percentage'] = round($percentage['index'] / $percentage['total'] * 100);
                        $session->set('percentage', $percentage, 'SPTransfer');
                } //Main loop end   

                if (method_exists($destination_model, 'rebuild')) {
                        $destination_model->rebuild();
                }

                //status completed
                $this->status = 'completed';
        }

        public function items_new_fix($pks = null)
        {
                // Initialize
                //$factory = $this->factory;
                //$source = $this->source;
                //$jAp = $this->jAp;
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                //$destination_query = $this->destination_query;
                //$source_query = $this->source_query;
                $destination_model = $this->destination_model;
                $this->destination_table = $destination_model->getTable();
                $source_db = $this->source_db;
                //$source_query = $this->source_query;
                //$destination_table = $this->destination_table;
                //$user = $this->user;
                //$params = $this->params;
                $task = $this->task;
                $id = $this->id;

                // Load items
                $query = 'SELECT destination_id
            FROM #__sptransfer_log
            WHERE tables_id = ' . (int) $task->id . ' AND ( state = 2 OR state = 3 )';
                $query .= ' ORDER BY id ASC';
                $destination_db->setQuery($query);
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                }
                $excludes = $destination_db->loadColumn();

                //Find ids
                if (is_null($pks[0])) {
                        $existing_id = true;
                        $query = $this->task->query;
                        $query .= $this->ordering;
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                        $pks = $destination_db->loadColumn();
                } else {
                        $existing_id = false;
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

                // Loop to save pks
                foreach ($pks as $pk) {

                        //Load data from source
                        if (!$existing_id) {
                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $task->id, "source_id" => $pk));
                                $pk = $tableLog->destination_id;
                        }

                        $exclude = array_search($pk, $excludes);
                        if ($exclude === false) {
                                continue;
                        } else {
                                unset($excludes[$exclude]);
                        }

                        //save with model
                        $destination_data = ArrayHelper::fromObject($destination_model->getItem($pk));

                        if (empty($destination_data[$id]) || ($destination_data[$id] == 0)) {
                                if ($existing_id) {
                                        exit($source_db->getErrorMsg());
                                } else {
                                        continue;
                                }
                        }

                        //status pending
                        $this->batch -= 1;
                        if ($this->batch < 0) {
                                return;
                        }

                        //tags      
                        unset($destination_data['tagsHelper']);
                        if (array_key_exists('tags', $destination_data)) {
                                unset($destination_data['tags']);
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_users_viewlevels':
                                        $destination_data = $this->com_users_viewlevels_fix($destination_data);
                                        break;
                                case 'com_users_users':
                                        $destination_data = $this->com_users_users_fix($destination_data);
                                        break;
                                case 'com_banners_banners':
                                        $destination_data = $this->com_banners_banners_fix($destination_data);
                                        break;
                                case 'com_menus_menu':
                                        $destination_data = $this->com_menus_menu_fix($destination_data);
                                        break;
                                case 'com_modules_modules':
                                        $this->com_modules_modules_fix($destination_data);
                                        break;
                        }

                        // Set destination_id
                        //created_by
                        if ($destination_data['created_by'] > 0) {
                                $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['created_by']));
                                if ($tableLog->source_id != $tableLog->destination_id) {
                                        $destination_data['created_by'] = $tableLog->destination_id;
                                }
                        }

                        //modified_by
                        /*
                          if ($destination_data['modified_by'] > 0) {
                          $tableLog->load(array("tables_id" => 3, "source_id" => $destination_data['modified_by']));
                          if ($tableLog->source_id != $tableLog->destination_id) {
                          $destination_data['modified_by'] = $tableLog->destination_id;
                          }
                          }
                         * 
                         */

                        //catid
                        if ($destination_data['catid'] > 1) {

                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $this->task->category, "source_id" => $destination_data['catid']));
                                if ($tableLog->source_id == $tableLog->destination_id) {
                                        $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                                        $tableLog->state = 4;
                                        $tableLog->store();
                                        continue;
                                }
                                $destination_data['catid'] = $tableLog->destination_id;
                        } /* else {
                          $tableLog->reset();
                          $tableLog->id = null;
                          $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                          $tableLog->state = 4;
                          $tableLog->store();
                          continue;
                          }
                         * 
                         */

                        //parent_id
                        if ($destination_data['parent_id'] > 1) {
                                $tableLog->reset();
                                $tableLog->id = null;
                                $tableLog->load(array("tables_id" => $task->id, "source_id" => $destination_data['parent_id']));
                                $destination_data['parent_id'] = $tableLog->destination_id;
                        }

                        //Password
                        if (array_key_exists('password', $destination_data)) {
                                $destination_data['password2'] = $destination_data['password'];
                        }

                        //log            
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => $task->id, "destination_id" => $destination_data['id']));
                        $tableLog->created = null;
                        $tableLog->state = 3;
                        $tableLog->tables_id = $task->id;

                        //save model
                        try {
                                $destination_model->save($destination_data);
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = $exc->getMessage();
                                $tableLog->store();
                                exit($exc->getMessage());
                                continue;
                        }

                        //add extra coding
                        $this->tableLog = $tableLog;
                        switch ($task->extension_name . '_' . $task->name) {
                                case 'com_users_users':
                                        $this->com_users_users_fix_new($destination_data);
                                        break;
                        }

                        //Log
                        $tableLog->state = 4;
                        $tableLog->store();
                        $percentage['index'] += 1;
                        $percentage['percentage'] = round($percentage['index'] / $percentage['total'] * 100);
                        $session->set('percentage', $percentage, 'SPTransfer');
                } //Main loop end   

                if (method_exists($destination_model, 'rebuild')) {
                        $destination_model->rebuild();
                }

                //status completed
                $this->status = 'completed';
        }

        private function com_users_users()
        {
                $tableLog = $this->tableLog;
                //$factory = $this->factory;
                $source_db = $this->source_db;
                $destination_db = $this->destination_db;

                // User Usergroup Map
                $query = 'SELECT group_id'
                        . ' FROM #__user_usergroup_map '
                        . ' WHERE user_id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $group_ids = $source_db->loadColumn();
                foreach ($group_ids as $group_id) {
                        $query = "INSERT INTO #__user_usergroup_map" .
                                " (user_id,group_id)" .
                                " VALUES (" . $destination_db->quote($tableLog->destination_id) . ',' . $destination_db->quote($group_id) . ")";
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                $tableLog->store();
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                                continue;
                        }
                }

                // User Profiles
                $query = 'SELECT *'
                        . ' FROM #__user_profiles '
                        . ' WHERE user_id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $profiles = $source_db->loadObjectList();
                foreach ($profiles as $profile) {
                        $query = "INSERT INTO #__user_profiles" .
                                " (user_id,profile_key,profile_value,ordering)" .
                                " VALUES (" . $destination_db->quote($profile->user_id) .
                                ',' . $destination_db->quote($profile->profile_key) .
                                ',' . $destination_db->quote($profile->profile_value) .
                                ',' . $destination_db->quote($profile->ordering) .
                                ")";
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                $tableLog->store();
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                                continue;
                        }
                }
        }

        private function com_users_users_fix($item)
        {

                $tableLog = $this->tableLog;

                $groups = $item['groups'];
                $item['groups'] = null;
                //groups
                foreach ($groups as $value) {
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => 1, "source_id" => $value));
                        $item['groups'][$tableLog->destination_id] = $tableLog->destination_id;
                }

                return $item;
        }

        private function com_users_users_fix_new($item)
        {
                $tableLog = $this->tableLog;
                $source_db = $this->source_db;
                $destination_db = $this->destination_db;

                //load password from source
                $query = 'SELECT password
                FROM #__users
                WHERE id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $password = $source_db->loadResult();

                //update in destination
                $query = "UPDATE `#__users` SET `password` = '" . $password . "' WHERE `id` = " . (int) $tableLog->destination_id;
                $destination_db->setQuery($query);
                $destination_db->execute();

                return true;
        }

        private function com_users_viewlevels_fix($item)
        {
                $tableLog = $this->tableLog;

                $rules = $item['rules'];

                foreach ($rules as $k => $rule) {
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => 1, "source_id" => $rule));
                        $rules2[$k] = (int) $tableLog->destination_id;
                        if ($rules2[$k] == 0) {
                                $rules2[$k] = 1;
                        }
                }
                $item['rules'] = $rules2;

                return $item;
        }

        private function com_content_content()
        {
                $tableLog = $this->tableLog;
                $source_db = $this->source_db;
                $destination_db = $this->destination_db;

                //featured
                $query = 'SELECT *
                FROM #__content_frontpage
                WHERE content_id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $result = $source_db->loadAssoc();
                if (!is_null($result)) {
                        $destination_db->setQuery(
                                "REPLACE INTO #__content_frontpage
                        (content_id, ordering)
                        VALUES (" . $tableLog->destination_id . " , " . $result['ordering'] . ")"
                        );
                        $destination_db->execute();
                } else {
                        $destination_db->setQuery(
                                "DELETE FROM #__content_frontpage
                        WHERE content_id = " . $destination_db->quote($tableLog->destination_id)
                        );
                        $destination_db->execute();
                }

                //rating
                $query = 'SELECT *
                FROM #__content_rating
                WHERE content_id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $result = $source_db->loadAssoc();
                if (!is_null($result)) {
                        $destination_db->setQuery(
                                "REPLACE INTO #__content_rating
                        (content_id, rating_sum, rating_count, lastip)
                        VALUES (" . $tableLog->destination_id . " , " . $result['rating_sum'] . " , " . $result['rating_count'] . " , '" . $result['lastip'] . "')"
                        );
                        $destination_db->execute();
                }
        }

        private function com_banners_banners()
        {
                $tableLog = $this->tableLog;
                $source_db = $this->source_db;
                $destination_db = $this->destination_db;

                //banner tracks
                $query = 'SELECT *
                FROM #__banner_tracks
                WHERE banner_id = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $result = $source_db->loadAssoc();
                if (!is_null($result)) {
                        $query = "INSERT INTO #__banner_tracks
                        (track_date, track_type, banner_id, count)
                        VALUES (" . $destination_db->quote($result['track_date']) . " , " .
                                $destination_db->quote($result['track_type']) . " , " .
                                $destination_db->quote($tableLog->destination_id) . " , " .
                                $destination_db->quote($result['count']) .
                                ")";
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                }
        }

        private function com_banners_banners_fix($item)
        {
                $tableLog = $this->tableLog;

                //cid
                if ($item['cid'] > 0) {
                        $tableLog->load(array("tables_id" => 13, "source_id" => $item['cid']));
                        if ($tableLog->source_id != $tableLog->destination_id) {
                                $item['cid'] = $tableLog->destination_id;
                        }
                }
                return $item;
        }

        private function com_menus_menu_fix($item)
        {
                $tableLog = $this->tableLog;
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;

                //menutype
                $menutype_table = new \Joomla\Component\Menus\Administrator\Table\MenuTypeTable($this->destination_db);
                $menutype_table->load(array("menutype" => $item['menutype']));
                if (empty($menutype_table->id)) {
                        $query = 'SELECT menutype FROM #__menu_types WHERE menutype LIKE "' . $item['menutype'] . '-sp-%"';
                        $destination_db->setQuery($query);
                        $destination_db->execute();
                        $item['menutype'] = $destination_db->loadResult();
                }

                //component_id
                $query = "SELECT component_id FROM #__menu WHERE id = " . (int) $item['id'];
                $destination_db->setQuery($query);
                $destination_db->execute();
                $extension_id = $destination_db->loadResult();
                $query = "SELECT name FROM #__extensions WHERE extension_id = " . (int) $extension_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $name = $source_db->loadResult();
                $query = 'SELECT extension_id FROM #__extensions WHERE name LIKE "' . $name . '"';
                $destination_db->setQuery($query);
                $destination_db->execute();
                $item['component_id'] = $destination_db->loadResult();

                //parent_id
                /*
                  if ($item['parent_id'] > 1) {
                  $tableLog->reset();
                  $tableLog->id = null;
                  $tableLog->load(array("tables_id" => $task->id, "source_id" => $item['parent_id']));
                  $item['parent_id'] = $tableLog->destination_id;
                  }
                 * 
                 */

                //link
                $link_1 = preg_split('/[&=]/', str_replace('index.php?', '', $item['link']));
                foreach ($link_1 as $key => $value) {
                        if ($key % 2 == 0) {
                                $link[$value] = $link_1[$key + 1];
                        }
                }


                $query = 'SELECT id FROM #__sptransfer_tables' .
                        ' WHERE extension_name LIKE ' . $destination_db->quote($link['option']);
                if (($link['view'] == 'category') || ($link['view'] == 'categories')) {
                        $query .= " AND name LIKE 'categories'";
                } else {
                        $query .= " AND name  NOT LIKE 'categories'";
                }
                $destination_db->setQuery($query);
                $destination_db->execute();
                $table_id = $destination_db->loadResult();
                $tableLog->reset();
                $tableLog->id = null;
                $tableLog->load(array("tables_id" => $table_id, "source_id" => $link['id']));
                $item['link'] = str_replace('id=' . $link['id'], 'id=' . $tableLog->destination_id, $item['link']);

                return $item;
        }

        private function com_modules_modules()
        {
                $destination_db = $this->destination_db;
                $tableLog = $this->tableLog;
                $source_db = $this->source_db;
                $factory = $this->factory;

                // Modules_Menu
                //First delete
                $destination_db->setQuery(
                        "DELETE FROM #__modules_menu
                    WHERE moduleid = " . $destination_db->quote($tableLog->destination_id)
                );
                $destination_db->execute();
                //Then insert
                $query = 'SELECT *'
                        . ' FROM #__modules_menu '
                        . ' WHERE moduleid = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $modules_menus = $source_db->loadAssocList();
                foreach ($modules_menus as $modules_menu) {
                        $query = "INSERT INTO #__modules_menu" .
                                " (moduleid,menuid)" .
                                " VALUES (" . $destination_db->quote($tableLog->destination_id) . ',' . $destination_db->quote($modules_menu['menuid']) . ")";
                        $destination_db->setQuery($query);
                        try {
                                $destination_db->execute();
                        } catch (\RuntimeException $exc) {
                                $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                                $tableLog->store();
                                exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        }
                }
        }

        private function com_modules_modules_fix($item)
        {
                $destination_db = $this->destination_db;
                $source_db = $this->source_db;
                $tableLog = $this->tableLog;
                $factory = $this->factory;
                $task = $this->task;

                // Set destination_id
                $tableLog->reset();
                $tableLog->id = null;
                $tableLog->load(array("tables_id" => 16, "source_id" => $item['menuid']));
                $item['menuid'] = $tableLog->destination_id;
                $menuid = $tableLog->source_id;
                if ($tableLog->source_id == $tableLog->destination_id) {
                        $tableLog->load(array("tables_id" => $task->id, "destination_id" => $item['id']));
                        $tableLog->state = 4;
                        $tableLog->store();
                        return;
                }

                //log            
                $tableLog->reset();
                $tableLog->id = null;
                $tableLog->load(array("tables_id" => $task->id, "destination_id" => $item['id']));
                $tableLog->created = null;
                $tableLog->state = 3;
                $tableLog->tables_id = $task->id;

                // update
                $query = 'UPDATE #__modules_menu '
                        . ' SET menuid = ' . (int) $item['menuid']
                        . ' WHERE moduleid = ' . (int) $tableLog->destination_id
                        . ' AND menuid = ' . (int) $menuid;;
                $destination_db->setQuery($query);
                $destination_db->execute();
                $source_db->loadResult();
                try {
                        $destination_db->execute();
                } catch (\RuntimeException $exc) {
                        $tableLog->note = '[' . $exc->getCode() . '] - ' . $exc->getMessage();
                        $tableLog->store();
                        exit('[' . $exc->getCode() . '] - ' . $exc->getMessage());
                        return;
                }
        }

        private function com_fields_fields()
        {
                $tableLog = $this->tableLog;
                $source_db = $this->source_db;
                $destination_db = $this->destination_db;

                //values
                $query = 'SELECT *
                FROM #__fields_values
                WHERE `field_id` = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $fields_values = $source_db->loadAssocList();
                foreach ($fields_values as $fields_value) {
                        $destination_db->setQuery(
                                "REPLACE INTO #__fields_values
                        (`field_id`, `item_id`, `value`)
                        VALUES (" . $destination_db->q($tableLog->destination_id) . " , " . $destination_db->q($fields_value['item_id']) . " , " . $destination_db->q($fields_value['value']) . ")"
                        );
                        $destination_db->execute();
                }

                //categories
                $query = 'SELECT *
                FROM #__fields_categories
                WHERE `field_id` = ' . (int) $tableLog->source_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $result = $source_db->loadAssoc();
                if (!is_null($result)) {
                        $destination_db->setQuery(
                                "REPLACE INTO #__fields_categories
                        (`field_id`, `category_id`)
                        VALUES (" . $destination_db->q($tableLog->destination_id) . " , " . $destination_db->q($result['category_id']) . ")"
                        );
                        $destination_db->execute();
                }
        }

        private function getRules($asset_id)
        {
                $source_db = $this->source_db;

                // update
                $query = 'SELECT rules FROM #__assets '
                        . ' WHERE id = ' . (int) $asset_id;
                $source_db->setQuery($query);
                $source_db->execute();
                $rules_json = $source_db->loadResult();
                $rules_object = json_decode($rules_json);
                $rules_array = ArrayHelper::fromObject($rules_object);
                return $rules_array;
        }

        private function convertTags($tags)
        {
                $tagsArray = explode(',', $tags);

                $tableLog = $this->tableLog;

                foreach ($tagsArray as $key => $tagID) {
                        $tableLog->reset();
                        $tableLog->id = null;
                        $tableLog->load(array("tables_id" => 20, "source_id" => $tagID));
                        if ($tableLog->destination_id == 0)
                                return null;
                        $tagsArray[$key] = (string) $tableLog->destination_id;
                }

                return $tagsArray;
        }

        public function getResult()
        {

                $result = array();
                $result['status'] = $this->status;
                $result['message'] = $this->task->extension_name . ' - ' . $this->task->name;

                return $result;
        }
}
