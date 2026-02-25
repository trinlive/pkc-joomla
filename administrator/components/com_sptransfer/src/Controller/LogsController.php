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

namespace Joomla\Component\Sptransfer\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

/**
 * Description of LogsController
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class LogsController extends BaseController {

        /**
         * @var		string	The context for persistent state.
         * @since	1.6
         */
        protected $context = 'com_sptransfer.log';

        /**
         * Method to remove a record.
         *
         * @return	void
         * @since	1.6
         */
        public function delete() {
                // Check for request forgeries.
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                // Get the model.
                $model = $this->getModel();

                // Load the filter state.
                $app = Factory::getApplication();

                $tablesId = $app->getUserState($this->context . '.filter.tables_id');
                $model->setState('filter.tables_id', $tablesId);

                $state = $app->getUserState($this->context . '.filter.state');
                $model->setState('filter.state', $state);

                $begin = $app->getUserState($this->context . '.filter.begin');
                $model->setState('filter.begin', $begin);

                $end = $app->getUserState($this->context . '.filter.end');
                $model->setState('filter.end', $end);

                $model->setState('list.limit', 0);
                $model->setState('list.start', 0);

                $count = $model->getTotal();
                // Remove the items.
                if (!$model->delete()) {
                        Factory::getApplication()->enqueueMessage($model->getError(), 'warning');
                } else {
                        $this->setMessage(Text::plural('COM_SPTRANSFER_TRACKS_N_ITEMS_DELETED', $count));
                }

                $this->setRedirect('index.php?option=com_sptransfer&view=logs');
        }

        public function delete_ind() {

                // Check for request forgeries.
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                $ids = Factory::getApplication()->input->get('cid', array(), '', 'array');
                $model = $this->getModel();
                if (!$model->delete_ind($ids)) {
                        Factory::getApplication()->enqueueMessage($model->getError(), 'error');
                } else {
                        $this->setMessage(Text::plural('COM_SPTRANSFER_TRACKS_N_ITEMS_DELETED', count($ids)));
                }

                $this->setRedirect('index.php?option=com_sptransfer&view=logs');
        }

        public function get_last_id() {

                $model = $this->getModel();
                $result = $model->get_last_id();
                exit($result);
        }

        public function get_file_log() {

                $model = $this->getModel();
                $result = $model->get_file_log();
                exit($result);
        }

}
