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

namespace Joomla\Component\Sptransfer\Administrator\View\Cpanel;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
include_once JPATH_ROOT . '/libraries/kainotomo/utilities/RemoteupdateModel.php';
use Joomla\Library\Kainotomo\RemoteUpdateModel;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;

/**
 * View class for a list of articles.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView {
        
        /**
         * Source database connection status
         * 
         * @var boolean True if successful connection, or false if failed
         */
        protected $DbConnection;
        
        /**
         * Source FTP connection status
         * 
         * @var boolean True if successful connection, or false if failed
         */
        protected $FtpConnection;

        /**
         * Display the view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
         *
         * @return  mixed  A string if successful, otherwise an Error object.
         */
        public function display($tpl = null) {
                
                //live update
                $remoteupdate = new RemoteUpdateModel(Array('extension' => 'com_sptransfer'));
                if ($remoteupdate->setDownloadId()) {
                        $remoteupdate->updateDownloadId('pkg_sptransfer');
                        $remoteupdate->updateDownloadId('kainotomo');
                }
                
                SptransferHelper::addSubmenu('cpanel');
                
                $this->addToolbar();
                
                $this->DbConnection = DatabaseHelper::ping(FALSE);
                $this->FtpConnection = FtpHelper::ping(FALSE);
                if ($this->DbConnection) {
                        $this->sidebar = \JHtmlSidebar::render();
                }                

                return parent::display($tpl);
        }

        /**
         * Add the page title and toolbar.
         *
         * @return  void
         *
         * @since   1.6
         */
        protected function addToolbar() {
                $canDo = SptransferHelper::getActions();

                ToolbarHelper::title(Text::_('COM_SPTRANSFER_TABLES_TITLE'), 'stack article');

                if ($canDo->get('core.admin')) {
                        ToolbarHelper::custom('cpanel.ping', 'loop', '', 'COM_SPTRANSFER_PING', false);
                        ToolbarHelper::divider();
                        ToolbarHelper::preferences('com_sptransfer');
                }

                ToolbarHelper::help(NULL, FALSE, "https://www.kainotomo.com/products/sp-transfer/documentation");
        }

}
