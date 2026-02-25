<?php

/*
 * Copyright (C) 2018 KAINOTOMO PH LTD <info@kainotomo.com>
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

use Joomla\CMS\Factory;
use Joomla\Component\Fields\Administrator\Table\FieldTable;
use Joomla\Component\Fields\Administrator\Table\GroupTable;

/**
 * Extends core fields class
 */
class FieldModel extends \Joomla\Component\Fields\Administrator\Model\FieldModel {

        public function getTable($name = 'Field', $prefix = 'Administrator', $options = array()) {
                
                if (empty($options['dbo'])) {
                        $options['dbo'] = $this->_db;
                }
                
                $table = new FieldTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

}

/**
 * Extends core fields group class
 */
class GroupModel extends \Joomla\Component\Fields\Administrator\Model\GroupModel {

        public function getTable($name = '', $prefix = '', $options = array()) {
                if (empty($options['dbo'])) {
                        $options['dbo'] = $this->_db;
                }
                
                $table = new GroupTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

}

/**
 * Description of Com_fieldsModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_fieldsModel extends ComModel{

        function __construct($config = array())
        {
                parent::__construct($config);
                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 2);
                }
        }
        
        public function fields_groups($ids = null) {

                $this->destination_model = new GroupModel(array('dbo' => $this->destination_db));
                $this->source_model = new GroupModel(array('dbo' => $this->source_db));

                //* Do not copy fields if missing
                try {
                        $this->source_model->getItem();
                } catch (\Throwable $th) {
                        $this->status = 'completed';
                        return;
                }

                $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->items_copy($ids);
        }

        public function fields_groups_fix($ids = null) {
                $this->destination_model = new GroupModel(array('dbo' => $this->destination_db));
                $this->source_model = new GroupModel(array('dbo' => $this->source_db));

                //* Do not copy fields if missing
                try {
                        $this->source_model->getItem();
                } catch (\Throwable $th) {
                        $this->status = 'completed';
                        return;
                }

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';

                $this->items_fix($ids);
        }

        public function fields($ids = null) {

                $this->destination_model = new FieldModel(array('dbo' => $this->destination_db));
                $this->source_model = new FieldModel(array('dbo' => $this->source_db));

                //* Do not copy fields if missing
                try {
                        $this->source_model->getItem();
                } catch (\Throwable $th) {
                        $this->status = 'completed';
                        return;
                }

                $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->ordering = ' ORDER BY ordering ASC, id ASC';
                $this->items_copy($ids);
        }

        public function fields_fix($ids = null) {
                $this->destination_model = new FieldModel(array('dbo' => $this->destination_db));
                $this->source_model = new FieldModel(array('dbo' => $this->source_db));

                //* Do not copy fields if missing
                try {
                        $this->source_model->getItem();
                } catch (\Throwable $th) {
                        $this->status = 'completed';
                        return;
                }

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';

                $this->items_fix($ids);
        }
}
