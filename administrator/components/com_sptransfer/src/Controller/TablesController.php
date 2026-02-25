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

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Application\CMSApplication;
use Joomla\Input\Input;

/**
 * Description of TablesController
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class TablesController extends AdminController
{

        /**
         * Constructor.
         *
         * @param   array                $config   An optional associative array of configuration settings.
         *                                         Recognized key values include 'name', 'default_task', 'model_path', and
         *                                         'view_path' (this list is not meant to be comprehensive).
         * @param   MVCFactoryInterface  $factory  The factory.
         * @param   CMSApplication       $app      The Application for the dispatcher
         * @param   Input                $input    The Input object for the request
         *
         * @since   3.0
         */
        public function __construct($config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null)
        {
                parent::__construct($config, $factory, $app, $input);
                $this->registerTask('transfer_all', 'transfer');
                $this->registerTask('fix_all', 'fix');
        }

        public function fix()
        {

                // Check for request forgeries
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                //Validate Input IDs
                $statuses = Factory::getApplication()->input->get('status', array(), '', 'array');
                $input_ids_full = Factory::getApplication()->input->get('input_ids', array(), '', 'array');
                $ids = Factory::getApplication()->input->get('cid', array(), '', 'array');
                $id = $ids[0];
                $input_ids = $this->validateInputIDs($input_ids_full, $statuses);

                if (!$input_ids) {
                        echo Text::_('COM_SPTRANSFER_MSG_ERROR_INVALID_IDS');
                        exit();
                }

                //Initial tasks
                //Disable warnings
                error_reporting(E_ERROR | E_PARSE);
                @set_time_limit(0);

                // Main Loop within extensions
                // Get the model.
                $model = $this->getModel();

                //Loop on ids

                if (!($item = $model->getItem($id))) {
                        exit($model->getError());
                }

                $status = $this->getStatus($statuses);
                $modelContent = $this->getModel($item->extension_name, '', array('task' => $item, 'status' => $status));
                $modelContent->{$item->name . '_fix'}($input_ids);

                //end of loop
                // Finish
                //enable warnings
                error_reporting(E_ALL);
                @set_time_limit(30);

                $result = $modelContent->getResult();
                exit(json_encode($result));
        }

        public function transfer()
        {
                // Check for request forgeries
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                //Validate Input IDs
                $statuses = Factory::getApplication()->input->get('status', array(), '', 'array');
                $input_ids_full = Factory::getApplication()->input->get('input_ids', array(), '', 'array');
                $ids = Factory::getApplication()->input->get('cid', array(), '', 'array');
                $id = $ids[0];
                $input_ids = $this->validateInputIDs($input_ids_full, $statuses);

                if (!$input_ids) {
                        echo Text::_('COM_SPTRANSFER_MSG_ERROR_INVALID_IDS');
                        exit();
                }

                //Initial tasks
                //Disable warnings
                error_reporting(E_ERROR | E_PARSE);
                @set_time_limit(0);

                //monitor log        
                // Get the model.
                $model = parent::getModel();

                //Main Loop
                //Loop on ids

                if (!($item = $model->getItem($id))) {
                        exit($model->getError());
                }
                $status = $this->getStatus($statuses);
                $modelContent = parent::getModel($item->extension_name, '', array('task' => $item, 'status' => $status));

                echo $modelContent->{$item->name}($input_ids);

                //end of loop
                // Finish
                //enable warnings
                error_reporting(E_ALL);
                @set_time_limit(30);

                $result = $modelContent->getResult();
                exit(json_encode($result));
        }

        function validateInputIDs($input_ids, $statuses)
        {
                $return = array();
                foreach ($input_ids as $i => $value) {
                        if ($statuses[$i] != 'completed' && $value != "") {
                                $ranges = explode(",", $value);
                                foreach ($ranges as $range) {
                                        if (preg_match("/^[0-9]*$/", $range)) {
                                                $return[] = $range;
                                        } else {
                                                if (preg_match("/^[0-9]*-[0-9]*$/", $range)) {
                                                        $nums = explode("-", $range);
                                                        if ($nums[0] >= $nums[1]) {
                                                                return false;
                                                        }
                                                        for ($k = $nums[0]; $k <= $nums[1]; $k++) {
                                                                $return[] = $k;
                                                        }
                                                } else {
                                                        return false;
                                                }
                                        }
                                }
                                break;
                        }
                }
                if (count($return) == 0) {
                        return true;
                } else {
                        return $return;
                }
        }

        function getStatus($statuses)
        {

                foreach ($statuses as $value) {
                        if ($value != 'completed') {
                                return $value;
                        }
                }

                return 'completed';
        }
}
