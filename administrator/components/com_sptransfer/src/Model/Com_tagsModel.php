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

use Joomla\CMS\Factory;
use Joomla\Component\Tags\Administrator\Table\TagTable;

class TagModel extends \Joomla\Component\Tags\Administrator\Model\TagModel
{

        public function getTable($name = 'Tag', $prefix = 'Table', $options = array())
        {
                if (empty($options['dbo'])) {
                        $options['dbo'] = $this->_db;
                }

                $table = new TagTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

        protected function canDelete($record)
        {
                return true;
        }
}

/**
 * Description of Com_tagsModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_tagsModel extends ComModel
{

        function __construct($config = array())
        {
                parent::__construct($config);
                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 2);
                }
        }

        public function tags($ids = null)
        {
                /*
          $tags = new JHelperTags;
          Factory::$database = $this->source_db;
          $query = $tags->getTagItemsQuery(2);
          $this->source_db->setQuery($query);
          $this->source_db->execute();
          $msg = $this->source_db->loadAssocList();
          PHFactory::print_r($msg);
          Factory::$database = $this->destination_db;
          return;
         * 
         */

                $this->destination_model = new TagModel(array('dbo' => $this->destination_db));
                $this->source_model = new TagModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 1';

                $this->ordering = ' ORDER BY level ASC, lft ASC, id ASC';
                $this->items_copy($ids);
        }

        public function tags_fix($ids = null)
        {

                $this->destination_model = new TagModel(array('dbo' => $this->destination_db));
                $this->source_model = new TagModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 1';

                $this->items_fix($ids);
        }
}
