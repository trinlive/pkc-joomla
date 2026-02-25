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
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Factory;

/**
 * Methods supporting a list of records from source database.
 *
 * @since  5.0.0
 */
class SelectsModel extends ListModel
{

        /**
         * Constructor that set @param SourceSiteHelper $SourceSite
         * 
         * @param type $config
         * @param \Joomla\CMS\MVCFactory\MVCFactoryInterface $factory
         */
        public function __construct($config = array(), MVCFactoryInterface $factory = null)
        {
                parent::__construct($config, $factory);
                $this->setDatabase(DatabaseHelper::getSourceDbo());
        }

        /**
         * Method to get a store id based on model configuration state.
         *
         * This is necessary because the model is used by the component and
         * different modules that might need different sets of data or different
         * ordering requirements.
         *
         * @param   string  $id  A prefix for the store id.
         *
         * @return  string  A store id.
         *
         * @since   1.6
         */
        protected function getStoreId($id = '')
        {
                // Compile the store id.
                $id .= ':' . $this->getState('filter.search');

                return parent::getStoreId($id);
        }

        protected function populateState($ordering = null, $direction = null)
        {

                //Get table name
                $name = Factory::getApplication()->input->get('name');
                $this->setState('name', $name);
                $extension_name = Factory::getApplication()->input->get('extension_name');
                $this->setState('extension_name', $extension_name);
                $cid = Factory::getApplication()->input->get('cid');
                $this->setState('cid', $cid);

                $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
                $this->setState('filter.search', $search);

                $search_field = $this->getUserStateFromRequest($this->context . '.filter.search_field', 'filter_search_field');
                $this->setState('filter.search_field', $search_field);

                return parent::populateState($ordering, $direction);
        }

        protected function getListQuery()
        {
                $db = DatabaseHelper::getSourceDbo();
                $this->setDatabase($db);
                $query = $db->getQuery(true);
                /*
                  // Select the required fields from the table.
                  $column_name = $this->getColumnName();
                  $name = $this->getState('name');
                  $query->select('*');
                  $query->from('#__'.$name.' AS a');
                  $query->order($column_name.' ASC');
                 * 
                 */

                $name = $this->getState('name');

                $queryTXT = 'SHOW KEYS FROM #__' . $name
                        . ' WHERE ' . $db->qn('Key_name') . ' LIKE ' . $db->q('PRIMARY');
                $db->setQuery($queryTXT);
                $pk_column_name = $db->loadAssoc()['Column_name'];
                if (!is_null($pk_column_name)) {
                        $query->select('a.' . $pk_column_name . ' AS sp_id, a.*')
                                ->from('#__' . $name . ' AS a');
                } else {
                        $query = 'select @rownum:=@rownum+1 sp_id, a.* from #__' . $name
                                . ' a, (SELECT @rownum:=-1) r'
                                . ' ORDER BY sp_id ASC';
                }

                $search = $this->getState('filter.search');
                $search_field = $this->getState('filter.search_field');
                if (!empty($search) && !empty($search_field)) {
                        $search = $db->quote('%' . str_replace(' ', '%', trim($search) . '%'));
                        $query->where('a.' . $search_field . ' LIKE ' . $search);
                }

                // Filter categories
                $extension_name = $this->getState('extension_name');
                if ($name == "categories") {
                        $tablesModel = new TablesModel();
                        $extensionsNames = $tablesModel->getExtensionsNames();
                        if(array_search($extension_name, $extensionsNames) !== false) {
                                $query->where('a.extension LIKE ' . $db->q($extension_name));
                        }
                }

                return $query;
        }

        public function getItems()
        {
                $items = parent::getItems();
                foreach ($items as $item) {
                        foreach ($item as $key => $value) {
                                $item->{$key} = $this->softTrim(strip_tags($value));
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
}
