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
use Joomla\Component\Menus\Administrator\Table\MenuTable;
use Joomla\Component\Menus\Administrator\Table\MenuTypeTable;
use Joomla\CMS\Language\Text;

class MenuModel extends \Joomla\Component\Menus\Administrator\Model\MenuModel {

        public function getTable($type = 'MenuType', $prefix = '\JTable', $config = array()) {
                if (empty($config['dbo'])) {
                        $config['dbo'] = $this->_db;
                }

                $table = new MenuTypeTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

        protected function canDelete($record) {
                $record = true;
                return $record;
        }

}

class ItemModel extends \Joomla\Component\Menus\Administrator\Model\ItemModel {

        public function getTable($type = 'Menu', $prefix = 'Administrator', $config = array()) {

                if (empty($config['dbo'])) {
                        $config['dbo'] = $this->_db;
                }

                $table = new MenuTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

        protected function canDelete($record) {
                $record = true;
                return $record;
        }

        public function getItem($pk = null) {
                $this->setState('item.type', false);
                return parent::getItem($pk);
        }

}

/**
 * Description of Com_menusModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_menusModel extends ComModel {

        function __construct($config = array())
        {
                parent::__construct($config);
                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 1);
                }
                $this->params->set('duplicate_alias', 0);
        }

        public function menu_types($ids = null) {

                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 2);
                }

                $this->destination_model = new MenuModel(array('dbo' => $this->destination_db));
                $this->source_model = new MenuModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->alias = 'menutype';
                $this->task->state = 4; //state for success

                $this->items_copy($ids);

                //Fix bug that menutype is inserted in menu id=1
                $this->destination_query->update('#__menu')
                        ->set($this->destination_db->qn('menutype') . '=' . $this->destination_db->q(''))
                        ->where($this->destination_db->qn('id') . '=' . $this->destination_db->q('1'));
                $this->destination_db->setQuery($this->destination_query);
                $this->destination_db->execute();
        }

        public function menu($ids = null) {

                $this->destination_model = new ItemModel(array('dbo' => $this->destination_db));                
                $this->source_model = new ItemModel(array('dbo' => $this->source_db));

                if (!($this->task->query = $this->menu_query())) {
                        return;
                }

                $this->ordering = ' ORDER BY level ASC, lft ASC, id ASC';

                $this->items_copy($ids);
        }

        public function menu_types_fix($ids = null) {
                $task = $this->task;
                //status completed
                $this->status = 'completed';
                return;
        }

        public function menu_fix($ids = null) {

                $this->destination_model = new ItemModel(array('dbo' => $this->destination_db));
                $this->source_model = new ItemModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE parent_id > 0';

                $this->items_fix($ids);
        }

        private function menu_query() {
                //Filter per menu_types already transferred
                $query = $this->destination_db->getQuery(true);
                $query->select('a.menutype');
                $query->from('#__menu_types AS a');
                $query->join('LEFT', '`#__sptransfer_log` AS b ON b.destination_id = a.id');
                $query->where('b.tables_id = 15 AND b.state >= 2');
                $query->order('b.id ASC');
                $this->destination_db->setQuery($query);
                try {
                        $this->destination_db->execute();
                } catch (\RuntimeException $exc) {
                        exit($exc->getMessage());
                }
                $temp2 = $this->destination_db->loadColumn();

                if (is_null($temp2[0])) {
                        exit('<p>' . Text::_('COM_SPTRANSFER_MENUTYPE_UNAVAILABLE') . '</p>');
                }

                foreach ($temp2 as $i => $temp3) {
                        if (strpos($temp3, '-sp-')) {
                                $temp4 = explode('-sp-', $temp3);
                                $temp3 = $temp4[0];
                        }
                        $temp2[$i] = '"' . $temp3 . '"';
                }

                $query = 'SELECT id 
            FROM #__menu
            WHERE id > 1';
                $query .= ' AND menutype IN (' . implode(',', $temp2) . ')';

                return $query;
        }

}
