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
use Joomla\Component\Banners\Administrator\Table\BannerTable;
use Joomla\Component\Banners\Administrator\Table\ClientTable;

class BannerModel extends \Joomla\Component\Banners\Administrator\Model\BannerModel
{

        public function getTable($name = '', $prefix = '', $options = array())
        {

                if (empty($options['dbo'])) {
                        $options['dbo'] = $this->_db;
                }

                $table = new BannerTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

        protected function canDelete($record)
        {
                $record = true;
                return $record;
        }
}

class ClientModel extends \Joomla\Component\Banners\Administrator\Model\ClientModel
{

        public function getTable($name = '', $prefix = '', $options = array())
        {

                if (empty($options['dbo'])) {
                        $options['dbo'] = $this->_db;
                }

                $table = new ClientTable($this->_db);
                $table->set('sp_id', $this->sp_id);
                return $table;
        }

        protected function canDelete($record)
        {
                $record = true;
                return $record;
        }
}

/**
 * Description of Com_contactModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_bannersModel extends ComModel
{

        function __construct($config = array())
        {
                parent::__construct($config);
                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 2);
                }
                $this->params->set('duplicate_alias', 0);
        }

        public function banner_clients($ids = null)
        {
                $this->destination_model = new ClientModel(array('dbo' => $this->destination_db));
                $this->source_model = new ClientModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->ordering = ' ORDER BY id ASC';
                $this->task->state = 4; //state for success

                $this->items_copy($ids);
        }

        public function banners($ids = null)
        {
                $this->destination_model = new BannerModel(array('dbo' => $this->destination_db));
                $this->source_model = new BannerModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->items_copy($ids);
        }

        public function banner_clients_fix($ids = null)
        {
                $task = $this->task;
                //status completed
                $this->status = 'completed';
                return;
        }

        public function banners_fix($ids = null)
        {
                $this->destination_model = new BannerModel(array('dbo' => $this->destination_db));
                $this->source_model = new BannerModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

                $this->items_fix($ids);
        }
}
