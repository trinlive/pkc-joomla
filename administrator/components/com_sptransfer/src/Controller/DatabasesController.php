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

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Component\Sptransfer\Administrator\Model\DatabasesModel;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Language\Text;

/**
 * Description of DatabasesController
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class DatabasesController extends AdminController {

        function transfer() {

                // Check for request forgeries
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                //Validate Input IDs   
                $statuses = $this->input->get('status', array(), '', 'array');
                $input_ids = $this->input->get('input_ids', array(), '', 'array');                
                $input_ids = $this->validateInputIDs($input_ids);
                if (!$input_ids) {
                        exit(Text::_('COM_SPTRANSFER_MSG_ERROR_INVALID_IDS'));
                }

                //Disable warnings
                error_reporting(E_ERROR | E_PARSE);
                @set_time_limit(0);

                // Main Loop within extensions
                //Get ids
                $ids = $this->input->get('cid', array(), '', 'array');
                $input_prefixes = $this->input->get('input_prefixes', array(), '', 'array');
                $input_names = $this->input->get('input_names', array(), '', 'array');
                $names = $this->input->get('names', array(), '', 'array');

                // Get the model.
                $model = parent::getModel();

                //Main Loop
                //Loop on ids
                if (empty($ids)) {
                        exit;
                }
                $id = $ids[0];

                $table_name = $input_prefixes[$id] . '_' . $input_names[$id];                
                $item = $model->getItem($table_name);

                if (is_null($item)) {
                        //Insert new item in tables
                        $item = $model->newItem($table_name);
                }
                if (is_null($item)) {
                        exit(Text::plural('COM_SPTRANSFER_DATABASE_FAILED', $table_name));
                }
                
                $status = $this->getStatus($statuses);
                $modelContent = parent::getModel('Com_database', '', array('task' => $item, 'status' => $status));
                $modelContent->setTable($input_prefixes[$id], $input_names[$id]);
                $modelContent->content($input_ids[$id], $input_prefixes[$id], $input_names[$id]);

                //end loop on ids
                // Finish
                error_reporting(E_ALL);
                @set_time_limit(30);

                $result = $modelContent->getResult();
                exit(json_encode($result));
        }

        /**
         * Validate User input ids
         * 
         * @param array $input_ids
         * @param array $task_ids
         * @return boolean
         */
        function validateInputIDs($input_ids) {
                $return = Array();
                foreach ($input_ids as $i => $ids) {
                        if ($ids != "") {
                                $ranges = explode(",", $ids);
                                foreach ($ranges as $range) {
                                        if (preg_match("/^[0-9]*$/", $range)) {
                                                $return[$i][] = $range;
                                        } else {
                                                if (preg_match("/^[0-9]*-[0-9]*$/", $range)) {
                                                        $nums = explode("-", $range);
                                                        if ($nums[0] >= $nums[1]) {
                                                                return false;
                                                        }
                                                        for ($k = $nums[0]; $k <= $nums[1]; $k++) {
                                                                $return[$i][] = $k;
                                                        }
                                                } else {
                                                        return false;
                                                }
                                        }
                                }
                        }
                }
                if (count($return) == 0) {
                        return true;
                } else {
                        return $return;
                }
        }

        /**
         * Get status of each item
         * 
         * @param array $statuses
         * @param array $ids
         * @param array $task_ids
         * @return array
         */
        function getStatus($statuses) {

                foreach ($statuses as $value) {
                        if ($value != 'completed') {
                                return $value;
                        }
                }

                return 'completed';
        }

}
