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
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;
use Joomla\CMS\Router\Route;

/**
 * Description of CpanelController
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class CpanelController extends AdminController {

        public function ping() {
                $this->setRedirect(Route::_('index.php?option=com_sptransfer'));
        }

        public function db() {
                DatabaseHelper::ping();
                $this->setRedirect(Route::_('index.php?option=com_sptransfer'));
        }

        public function ftp() {
                FtpHelper::ping();
                $this->setRedirect(Route::_('index.php?option=com_sptransfer'));
        }

}
