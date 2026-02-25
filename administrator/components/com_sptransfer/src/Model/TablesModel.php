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

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Description of TablesModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class TablesModel extends ListModel{
        
        public function getItem($pk) {
                
                $db = $this->getDbo();
                $query = $db->getQuery(true);

                // Select the required fields from the table.
                $query->select('*');
                $query->from('#__sptransfer_tables AS a');

                // Filter by id
                $query->where('a.id = ' . (int) $pk);

                $db->setQuery($query);
                $item = $db->loadObject();

                return $item;
        }

        protected function getListQuery($pk = null) {
                // Create a new query object.
                $db = $this->getDbo();
                $query = $db->getQuery(true);

                // Select the required fields from the table.
                $query->select(
                        $this->getState(
                                'list.select', 'a.id, a.extension_name, a.name, a.category, a.type, a.state'
                        )
                );
                $query->from('#__sptransfer_tables AS a');

                $query->where('a.extension_name NOT LIKE' . $db->q('com_database'));

                // Filter by extension_name
                // Join over the extension name
                if (!is_null($pk)) {
                        //$query->join('LEFT', '`#__extensions` AS l ON l.extension_name = a.extension_name GROUP BY a.extension_name');
                        $query->where('l.extension_id = ' . (int) $pk);
                }

                //Limit up to id < 1000
                $query->where('a.id < 1000');

                // Ordering
                $query->order('a.ordering ASC');

                return $query;
        }

        /**
         * Get the extension names unique 
         * 
         * @return array
         */
        public function getExtensionsNames() {
                $result = [];
                $items = $this->getItems();
                foreach ($items as $item) {
                        $result[] = $item->extension_name;
                }
                $result = array_unique($result);
                return $result;
        }
        
}
