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

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

/**
 * Description of FilesController
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class FilesController extends AdminController {
        
        public function display($cachable = false, $urlparams = array()) {
                $cachable = true;
                return parent::display($cachable, $urlparams);
        }

        function browse() {
                // Check for request forgeries
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                $url = 'index.php?option=com_sptransfer&view=files';

                //folder remote
                $folder_remote = Factory::getApplication()->input->getHtml('folder_remote');
                if (!empty($folder_remote)) {
                        $url .= '&folder_remote=' . $folder_remote;
                }

                //folder local
                $folder_local = Factory::getApplication()->input->getHtml('folder_local');
                if (!empty($folder_local)) {
                        $url .= '&folder_local=' . $folder_local;
                }

                $this->setRedirect($url);

                return;
        }

        function transfer() {
                // Check for request forgeries
                Session::checkToken() or exit(Text::_('JINVALID_TOKEN'));

                //delete log file
                $log_file = Factory::getConfig()->get('log_path') . DIRECTORY_SEPARATOR . 'com_sptransfer.php';
                if (file_exists($log_file)) {
                        unlink($log_file);
                }

                //Disable warnings
                error_reporting(E_ERROR | E_PARSE);
                @set_time_limit(0);

                $model = $this->getModel();
                if (!$model->transfer()) {
                        exit($model->getError());
                }

                // Finish
                //enable warnings
                error_reporting(E_ALL);
                @set_time_limit(30);

                $result = Array();
                $result['status'] = 'completed';
                exit(json_encode($result));
        }

}
