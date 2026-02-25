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

use Joomla\CMS\Factory;

defined('_JEXEC') or die;


class ModuleModel extends \Joomla\Component\Modules\Administrator\Model\ModuleModel
{

    public function getTable($type = 'Module', $prefix = 'JTable', $config = array())
    {
        if (empty($config['dbo'])) {
            $config['dbo'] = $this->_db;
        }

        $table = parent::getTable($type, $prefix, $config);
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
 * Description of Com_modulesModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_modulesModel extends ComModel
{

    function __construct($config = array())
    {
        parent::__construct($config);
        $jinput = Factory::getApplication()->input;
        if ($jinput->get('task') == 'transfer_all') {
            $this->params->set('new_ids', 1);
        }
    }

    public function modules($ids = null)
    {

        $this->destination_model = new ModuleModel(array('dbo' => $this->destination_db));
        $this->source_model = new ModuleModel(array('dbo' => $this->source_db));

        $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE client_id = 0';

        $this->ordering = ' ORDER BY ordering ASC, id ASC';
        
        $this->items_copy($ids);
    }
    public function modules_fix($ids = null)
    {

        $this->destination_model = new ModuleModel(array('dbo' => $this->destination_db));
        $this->source_model = new ModuleModel(array('dbo' => $this->source_db));

        $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE client_id = 0';

        $this->items_fix($ids);
    }
}
