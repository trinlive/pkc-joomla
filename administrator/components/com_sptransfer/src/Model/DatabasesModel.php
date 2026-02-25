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

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\CMS\Factory;

/**
 * Description of DatabasesModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class DatabasesModel extends ListModel
{

        public function __construct($config = array(),  \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null)
        {
                parent::__construct($config, $factory);

                $this->setDatabase(DatabaseHelper::getSourceDbo());
        }

        protected function getListQuery()
        {
                $this->setDatabase(DatabaseHelper::getSourceDbo());
                $db = $this->getDatabase();
                $params = ComponentHelper::getParams('com_sptransfer');
                $database = $params->get("source_database_name", '');
                $queryTxt = 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES' . 
                        ' WHERE TABLE_SCHEMA = ' . $db->quote($database) .
                        ' AND TABLE_NAME LIKE ' . $db->quote($db->getPrefix() . $this->getState('filter.search') . '%') . 
                        ' ORDER BY TABLE_NAME ' . $this->state->get('list.direction', 'asc');

                return $queryTxt;
        }

        public function getItems()
        {
                $items = parent::getItems();
                foreach ($items as $item) {
                        foreach ($item as $key => $value) {
                                $item->{$key} = $this->softTrim(strip_tags($value));
                        }
                }

                //Rename fields and keep only tables with same prefix
                $prefix = $this->getDbo()->getPrefix();
                $prefix2 = trim($prefix, '_');
                foreach ($items as $key => $item) {
                        if (strpos($item->TABLE_NAME, $prefix) == 0) {
                                $items[$key]->id = $key;
                                $item->prefix = $prefix2;
                                $item->name = str_replace($prefix, '', $item->TABLE_NAME);
                        }
                }

                return $items;
        }

        /**
         * Trim a string to the desired character length
         * 
         * @param string $text The text to trim
         * @param integer $count Number of characters
         * @param string $wrapText The text to add in the end
         * @return string The string result trimmed.
         */
        private function softTrim($text, $count = 75, $wrapText = '...')
        {
                if (strlen($text) > $count) {
                        preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
                        $text = $matches[0];
                } else {
                        $wrapText = '';
                }
                
                return $text . $wrapText;
        }

        public function getItem($table_name)
        {
                $db = Factory::getDbo();
                //$query = "SELECT * FROM #__sptransfer_tables WHERE `extension_name` LIKE 'com_database' AND `name` LIKE '".$table_name."'";

                $query = $db->getQuery(true);
                $query->select(
                        $this->getState(
                                'list.select',
                                'a.id, a.extension_name, a.name'
                        )
                );
                $query->from('#__sptransfer_tables AS a');
                $query->where("a.extension_name LIKE 'com_database'");
                $query->where("a.type LIKE " . $db->q('database'));
                $query->where("a.name LIKE '" . $table_name . "'");

                $db->setQuery($query);
                try {
                        $result = $db->loadObject();
                } catch (\RuntimeException $exc) {
                        exit($exc->getMessage());
                }

                return $result;
        }

        public function newItem($table_name)
        {
                $db = Factory::getDbo();
                $query = "
            INSERT INTO  `#__sptransfer_tables` (
                `id` ,
                `extension_name` ,
                `name`,
                `type`
                )
                VALUES (
                NULL ,  'com_database',  '" . $table_name . "', 'database'
                );
            ";
                $db->setQuery($query);
                try {
                        $db->execute();
                } catch (\RuntimeException $exc) {
                        exit($exc->getMessage());
                }

                return $this->getItem($table_name);
        }
}
