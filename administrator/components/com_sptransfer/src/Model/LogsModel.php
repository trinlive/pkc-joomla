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
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use \Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Filesystem\Stream;

/**
 * Description of LogsModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class LogsModel extends ListModel {

        /**
         * @param type $config
         * @param \Joomla\CMS\MVCFactory\MVCFactoryInterface $factory
         */
        public function __construct($config = array(), MVCFactoryInterface $factory = null) {

                if (empty($config['filter_fields'])) {
                        $config['filter_fields'] = array(
                                'extension_name', 'b.extension_name',
                                'name', 'b.name',
                                'state', 'a.state',
                                'source_id', 'a.source_id',
                                'tables_id', 'a.tables_id',
                                'created', 'a.created',
                        );
                }

                parent::__construct($config, $factory);
        }

        protected $basename;

        protected function populateState($ordering = 'created', $direction = 'desc') {

                $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
                $this->setState('filter.search', $search);

                // Load the filter state.
                $tablesId = $this->getUserStateFromRequest($this->context . '.filter.tables_id', 'filter_tables_id');
                $this->setState('filter.tables_id', $tablesId);

                $state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state');
                $this->setState('filter.state', $state);

                $begin = $this->getUserStateFromRequest($this->context . '.filter.begin', 'filter_begin', '', 'string');
                $this->setState('filter.begin', $begin);

                $end = $this->getUserStateFromRequest($this->context . '.filter.end', 'filter_end', '', 'string');
                $this->setState('filter.end', $end);

                // Load the parameters.
                $params = ComponentHelper::getParams('com_sptransfer');
                $this->setState('params', $params);

                // List state information.
                parent::populateState($ordering, $direction);
        }

        protected function getListQuery() {

                //require_once JPATH_COMPONENT.'/helpers/banners.php';
                // Create a new query object.
                $db = $this->getDbo();
                $query = $db->getQuery(true);

                // Select the required fields from the table.
                $query->select(
                        'a.id as id,' .
                        'a.tables_id as tables_id,' .
                        'a.source_id as source_id,' .
                        'a.destination_id as destination_id,' .
                        'a.state as state,' .
                        'a.created as created,' .
                        'a.`note` as `note`'
                );
                $query->from('`#__sptransfer_log` AS a');

                // Join with the tables
                $query->join('LEFT', '`#__sptransfer_tables` as b ON b.id=a.tables_id');
                $query->select('b.extension_name as extension_name, b.name as name');

                // Filter by tables_id
                $tablesId = $this->getState('filter.tables_id');
                if (is_numeric($tablesId)) {
                        $query->where('a.tables_id = ' . (int) $tablesId);
                }

                // Filter by state
                $state = $this->getState('filter.state', 1);
                if ($state > 0) {
                        $query->where('a.state = ' . (int) $state);
                }

                // Filter by begin date
                $begin = $this->getState('filter.begin');
                if (!empty($begin)) {
                        $query->where('a.created >= ' . $db->Quote($begin));
                }

                // Filter by end date
                $end = $this->getState('filter.end');
                if (!empty($end)) {
                        $query->where('a.created <= ' . $db->Quote($end));
                }

                // Filter by search in title.
                $search = $this->getState('filter.search');
                if (!empty($search)) {
                        $query->where('(a.source_id = ' . (int) $search . ' OR a.destination_id = ' . (int) $search . ')');
                }

                // Add the list ordering clause.
                $orderCol = $this->state->get('list.ordering', 'created');
                $orderDirn = $this->state->get('list.direction', 'desc');

                $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

                return $query;
        }

        public function delete() {
                // Initialise variables
                $user = Factory::getUser();

                // Access checks.
                $allow = $user->authorise('core.delete', 'com_sptransfer');

                if ($allow) {
                        // Delete tracks from this banner
                        $db = $this->getDbo();
                        $query = $db->getQuery(true);
                        $query->delete();
                        $query->from('`#__sptransfer_log`');

                        // Filter by tables_id
                        $tablesId = $this->getState('filter.tables_id');
                        if (!empty($tablesId)) {
                                $query->where('tables_id = ' . (int) $tablesId);
                        }

                        // Filter by state
                        $state = $this->getState('filter.state');
                        if (!empty($state)) {
                                $query->where('state = ' . (int) $state);
                        }

                        // Filter by begin date
                        $begin = $this->getState('filter.begin');
                        if (!empty($begin)) {
                                $query->where('created >= ' . $db->Quote($begin));
                        }

                        // Filter by end date
                        $end = $this->getState('filter.end');
                        if (!empty($end)) {
                                $query->where('created <= ' . $db->Quote($end));
                        }

                        $db->setQuery((string) $query);
                        $this->setError((string) $query);
                        try {
                                $db->execute();
                        } catch (\RuntimeException $exc) {
                                Factory::getApplication()->enqueueMessage($exc->getMessage(), 'error');
                        }
                } else {
                        Factory::getApplication()->enqueueMessage(Text::_('JERROR_CORE_DELETE_NOT_PERMITTED'), 'warning');
                }

                return true;
        }

        public function delete_ind(&$pks) {
                $pks = (array) $pks;
                $table = $this->getTable('Log');

                // Iterate the items to delete each one.
                foreach ($pks as $pk) {

                        if ($table->load($pk)) {

                                if (!$table->delete($pk)) {
                                        $this->setError($table->getError());
                                        return false;
                                }
                        } else {

                                $this->setError($table->getError());
                                return false;
                        }
                }

                return true;
        }

        public function get_last_id() {
                $session = Factory::getSession();
                $percentage = $session->get('percentage', null, 'SPTransfer');
                if($percentage){
                        $perc = $percentage['percentage'] > 100 ? 100 : $percentage['percentage'];
                        $message = '<div class="progress">' .
                                '<div class="progress-bar" role="progressbar" style="width: '.$perc.'%;" aria-valuenow="'.$perc.'" aria-valuemin="0" aria-valuemax="100">'.$perc.'%</div>' .
                                '</div>';
                        return $message;
                }
                return '';
        }

        public function get_file_log() {

                jimport('joomla.filesystem.stream');

                $log_file = Factory::getConfig()->get('log_path') . DIRECTORY_SEPARATOR . 'com_sptransfer.php';
                $stream = new Stream();
                $stream->open($log_file);

                while ($result = $stream->gets()) {
                        $line = $result;
                }

                $message = '<p><b>Last Processed Item</b><p>' .
                        '<p>' .
                        $line .
                        '</p>';

                return $message;
        }

}
