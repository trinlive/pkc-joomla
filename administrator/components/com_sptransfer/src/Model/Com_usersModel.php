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
use Joomla\Component\Users\Administrator\Table\NoteTable;
use Joomla\CMS\User\UserFactoryAwareInterface;
use Joomla\CMS\User\UserFactoryAwareTrait;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\User\UserFactoryInterface;

class GroupModel extends \Joomla\Component\Users\Administrator\Model\GroupModel
{

        public function getTable($type = 'Usergroup', $prefix = 'Joomla\\CMS\\Table\\', $config = array())
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
                $record = $record;
                return true;
        }
}

class LevelModel extends \Joomla\Component\Users\Administrator\Model\LevelModel
{

        public function getTable($type = 'ViewLevel', $prefix = 'Joomla\\CMS\\Table\\', $config = array())
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
                return true;
        }
}

class UserModel extends \Joomla\Component\Users\Administrator\Model\UserModel implements UserFactoryAwareInterface
{
        use UserFactoryAwareTrait;

        /**
         * Constructor.
         *
         * @param   array                $config   An optional associative array of configuration settings.
         * @param   MVCFactoryInterface  $factory  The factory.
         *
         * @see     \Joomla\CMS\MVC\Model\BaseDatabaseModel
         * @since   3.2
         */
        public function __construct($config = [], MVCFactoryInterface $factory = null)
        {
                parent::__construct($config, $factory);
                $container = Factory::getContainer();
                $this->setUserFactory($container->get(UserFactoryInterface::class));
        }

        public function getTable($type = 'UserTable', $prefix = 'Joomla\\Component\\Sptransfer\\Administrator\\Table\\', $config = array())
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
                return true;
        }

        public function getItem($pk = null)
        {
                $item = parent::getItem($pk);
                if (empty($item->email)) {
                        $item->id = 0;
                }
                return $item;
        }
}

class NoteModel extends \Joomla\Component\Users\Administrator\Model\NoteModel
{

        public function getTable($name = 'Note', $prefix = 'Table', $options = array())
        {
                if (empty($config['dbo'])) {
                        $config['dbo'] = $this->_db;
                }

                return new NoteTable($this->_db);
        }

        protected function canDelete($record)
        {
                return true;
        }
}

/**
 * Description of Com_usersModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_usersModel extends ComModel
{

        function __construct($config = array())
        {
                parent::__construct($config);
                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 2);
                }
        }

        public function notes($ids = null)
        {
                $this->destination_model = new NoteModel(array('dbo' => $this->destination_db));
                $this->source_model = new NoteModel(array('dbo' => $this->source_db));

                $this->task->name = 'user_notes';

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';

                $this->items_copy($ids);
        }

        public function notes_fix($ids = null)
        {
                $this->destination_model = new NoteModel(array('dbo' => $this->destination_db));
                $this->source_model = new NoteModel(array('dbo' => $this->source_db));

                $this->task->name = 'user_notes';

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';

                $this->items_fix($ids);
        }

        public function usergroups($ids = null)
        {
                $this->params->set('duplicate_alias', 0);
                $this->destination_model = new GroupModel(array('dbo' => $this->destination_db));
                $this->source_model = new GroupModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE parent_id > 0';
                $this->alias = "title";

                $this->items_copy($ids);
        }

        public function usergroups_fix($ids = null)
        {
                $this->destination_model = new GroupModel(array('dbo' => $this->destination_db));
                $this->source_model = new GroupModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE parent_id > 0';
                $this->alias = "title";

                $this->items_fix($ids);
        }

        public function viewlevels($ids = null)
        {
                $this->destination_model = new LevelModel(array('dbo' => $this->destination_db));
                $this->source_model = new LevelModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';
                $this->alias = "title";

                $this->items_copy($ids);
        }

        public function viewlevels_fix($ids = null)
        {
                $this->destination_model = new LevelModel(array('dbo' => $this->destination_db));
                $this->source_model = new LevelModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';
                $this->alias = "title";

                $this->items_fix($ids);
        }

        public function users($ids = null)
        {

                $jinput = Factory::getApplication()->input;
                if ($jinput->get('task') == 'transfer_all') {
                        $this->params->set('new_ids', 1);
                }

                $this->destination_model = new UserModel(array('dbo' => $this->destination_db));
                $this->source_model = new UserModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';
                $this->alias = "username";

                $this->items_new($ids);
        }

        public function users_fix($ids = null)
        {
                $this->destination_model = new UserModel(array('dbo' => $this->destination_db));
                $this->source_model = new UserModel(array('dbo' => $this->source_db));

                $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE id > 0';

                $this->items_new_fix($ids);
        }
}
