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

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Factory;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;
use Joomla\Utilities\ArrayHelper;

/**
 * Description of FilesModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class FilesModel extends ListModel {

        public function __construct($config = array(), \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null) {
                parent::__construct($config, $factory);

                Log::addLogger(
                        array(
                    'text_file' => 'com_sptransfer.php',
                        ), Log::ALL, array('com_sptransfer')
                );
        }

        public function getState($property = null, $default = null) {

                static $set;

                if (!$set) {

                        //remote
                        $folder_remote = Factory::getApplication()->input->getHtml('folder_remote', '', '', 'path');
                        $this->setState('folder_remote', $folder_remote);

                        $parent_remote = str_replace("\\", "/", dirname($folder_remote));
                        $parent_remote = ($parent_remote == '.') ? null : $parent_remote;
                        $this->setState('parent_remote', $parent_remote);

                        //local
                        $folder_local = Factory::getApplication()->input->getHtml('folder_local', '', '', 'path');
                        $this->setState('folder_local', $folder_local);

                        $parent_local = str_replace("\\", "/", dirname($folder_local));
                        $parent_local = ($parent_local == '.') ? null : $parent_local;
                        $this->setState('parent_local', $parent_local);

                        $set = true;
                }

                return parent::getState($property, $default);
        }

        public function getItems() {
                $items = new \stdClass();
                $items->local = $this->getItemsLocal();
                $items->remote = $this->getItemsRemote();
                return $items;
        }

        public function getItemsLocal($folder_local = null) {

                // Get current path from request
                if (is_null($folder_local)) {
                        $folder_local = $this->getState('folder_local');
                }
                $current = $folder_local;


                if ($current == 'undefined') {
                        $current = '';
                }
                if (strlen($current) != '/') {
                        $basePath = str_replace('//', '/', JPATH_ROOT . '/' . $current);
                } else {
                        $basePath = JPATH_ROOT;
                }

                // Get the list of files and folders from the given folder
                $files = Folder::files($basePath);
                $folders = Folder::folders($basePath);
                $list = array();

                // Get parent path from request
                $parent = $this->getState('parent_local');
                if (!empty($current)) {
                        $tmp = new \stdClass();
                        $tmp->type = 1; //go up
                        $tmp->name = '..';
                        $tmp->icon_16 = "com_sptransfer/mime-icon-16/folderup.png";
                        if (empty($parent)) {
                                $tmp->path = '';
                        } else {
                                $tmp->path = $parent;
                        }
                        $list[] = $tmp;
                }

                foreach ($folders as $key => $item) {
                        $tmp = new \stdClass();
                        $tmp->type = 1;
                        $tmp->name = $item;
                        if ($current != '') {
                                $tmp->path = str_replace(DIRECTORY_SEPARATOR, '/', Path::clean($current . '/' . $item));
                        } else {
                                $tmp->path = str_replace(DIRECTORY_SEPARATOR, '/', Path::clean($item));
                        }

                        $tmp->icon_16 = "com_sptransfer/mime-icon-16/folder.png";
                        $list[] = $tmp;
                }

                foreach ($files as $key => $item) {
                        $tmp = new \stdClass();
                        $tmp->type = 0;
                        $tmp->name = $item;
                        $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                        $tmp->size = filesize($basePath . '/' . $item);
                        $tmp->icon_16 = "com_sptransfer/mime-icon-16/" . $ext . ".png";
                        $list[] = $tmp;
                }

                return $list;
        }

        public function getItemsRemote($folder_remote = null) {

                $params = ComponentHelper::getParams('com_sptransfer');
                $root = str_replace('//', '/', $params->get("ftp_root", '/'));

                // Get current path from request
                if (is_null($folder_remote)) {
                        $folder_remote = $this->getState('folder_remote');
                }
                $current = $folder_remote;

                if ($current == 'undefined') {
                        $current = '';
                }
                if (strlen($current) != '/') {
                        $basePath = str_replace('//', '/', $root . '/' . $current);
                } else {
                        $basePath = $root;
                }

                //connect
                if (!FtpHelper::ping(FALSE)) {
                        Factory::$application->enqueueMessage(Text::_('COM_SPTRANSFER_MSG_ERROR_CONNECTION_FTP2'), 'error');
                        return false;
                }

                $ftp = FtpHelper::getFtpClient();

                if (!$ftp->chdir($basePath)) {
                        Factory::$application->enqueueMessage(Text::sprintf('COM_SPTRANSFER_ERROR_PATH', $basePath), 'error');
                        return false;
                }

                $items = $ftp->scandir();

                $list = array();

                // Get parent path from request
                $parent = $this->getState('parent_remote');
                if (!empty($current)) {
                        $tmp = new \stdClass();
                        $tmp->type = 'directory'; //go up
                        $tmp->name = '..';
                        $tmp->icon_16 = "com_sptransfer/mime-icon-16/folderup.png";
                        if (empty($parent)) {
                                $tmp->path = '';
                        } else {
                                $tmp->path = $parent;
                        }
                        $list[] = $tmp;
                }

                foreach ($items as $item) {

                        if ($current != '') {
                                $item['path'] = str_replace(DIRECTORY_SEPARATOR, '/', Path::clean($current . '/' . $item['name']));
                        } else {
                                $item['path'] = str_replace(DIRECTORY_SEPARATOR, '/', Path::clean($item['name']));
                        }

                        switch ($item['type']) {
                                case 'file': //files
                                        //$tmp->path = str_replace(DIRECTORY_SEPARATOR, '/', JPath::clean($basePath . '/' . $detail['name']));
                                        //$tmp->path_relative = str_replace($mediaBase, '', $tmp->path);                    
                                        $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
                                        //$tmp->icon_32 = "media/mime-icon-32/".$ext.".png";
                                        $item['icon_16'] = "com_sptransfer/mime-icon-16/" . $ext . ".png";
                                        break;
                                case 'directory'://folders
                                        $item['icon_16'] = "com_sptransfer/mime-icon-16/folder.png";
                                        break;
                                case 'shortcut'://shortcuts
                                        $item['icon_16'] = "com_sptransfer/mime-icon-16/link.png";
                                        break;
                                case 'link'://shortcuts
                                        $item['icon_16'] = "com_sptransfer/mime-icon-16/link.png";
                                        break;
                                default:
                                        break;
                        }
                        if ($item['type'] != 'shortcut') {
                                $list[] = ArrayHelper::toObject($item);
                        }
                }

                return $list;
        }

        /**
         * Transfer from remote folder to local
         * 
         * @param type $folder_remote
         * @param type $folder_local
         * @param type $items
         * @return boolean
         */
        public function transfer($folder_remote = null, $folder_local = null, $items = null) {
                
                //connect if not connected
                if (is_null(FtpHelper::getFtpClient()->getConnection())) {
                        FtpHelper::ping();
                }

                //Define files and folder names
                if (is_null($items)) {
                        $ids = Factory::$application->input->get('cid', array(), '', 'array');
                        $items = array();
                        foreach ($ids as $id) {
                                $tmp = new \stdClass();
                                $hash_index = strpos($id, '#');
                                $tmp->type = substr($id, 0, $hash_index);
                                $tmp->name = substr($id, $hash_index + 1);
                                $items[] = $tmp;
                        }
                }

                //Define files and folder names
                if (is_null($items)) {
                        $items = $this->getItemsRemote($folder_remote);
                }

                // Get current path from request   
                if (is_null($folder_local)) {
                        $folder_local = $this->getState('folder_local');
                }

                $current_local = $folder_local;
                if ($current_local == 'undefined') {
                        $current_local = '';
                }
                if (strlen($current_local) != '/') {
                        $localPath = str_replace('//', '/', JPATH_ROOT . '/' . $current_local);
                } else {
                        $localPath = JPATH_ROOT;
                }

                $ftp = FtpHelper::getFtpClient();

                $root = FtpHelper::getFtpOptions()->root;

                // Get current path from request
                if (is_null($folder_remote)) {
                        $folder_remote = $this->getState('folder_remote');
                }
                $current = $folder_remote;

                if ($current == 'undefined') {
                        $current = '';
                }
                if (strlen($current) != '/') {
                        $basePath = str_replace('//', '/', $root . '/' . $current);
                } else {
                        $basePath = $root;
                }
                $basePath = str_replace('//', '/', $basePath);

                $replace = FtpHelper::getFtpOptions()->replace; //1 - no, 0 - yes

                foreach ($items as $item) {

                        if (!$ftp->chdir($basePath)) {
                                return false;
                        }
                        
                        if ($item->type == 'file') {
                                //file
                                if ($replace == 1 && File::exists($localPath . '/' . $item->name)) {
                                        Log::add(Text::sprintf('COM_SPTRANSFER_COPY_FILE_REPLACE', $localPath . '/' . $item->name), Log::NOTICE, 'com_sptransfer');
                                        continue;
                                } else {
                                        if (!$ftp->get($localPath . '/' . $item->name, $item->name, FTP_BINARY)) {
                                                exit('<p><font color="red">' . Text::sprintf('COM_SPTRANSFER_COPY_FILE_ERROR', $localPath . '/' . $item->name) . '</font></p>');
                                        } else {
                                                Log::add(Text::sprintf('COM_SPTRANSFER_COPY_FILE_SUCCESS', $localPath . '/' . $item->name), Log::NOTICE, 'com_sptransfer');
                                        }
                                }
                        } else {
                                //folder
                                if ($item->name != '..') {
                                        //create folder if not exist
                                        if (!file_exists($localPath . '/' . $item->name)) {
                                                if (!Folder::create($localPath . '/' . $item->name)) {
                                                        exit('<p><font color="red">' . Text::sprintf('COM_SPTRANSFER_CREATE_FOLDER_ERROR', $localPath . '/' . $item->name) . '</font></p>');
                                                } else {
                                                        Log::add(Text::sprintf('COM_SPTRANSFER_CREATE_FOLDER_SUCCESS', $localPath . '/' . $item->name), Log::NOTICE, 'com_sptransfer');
                                                }
                                        }

                                        //get new items
                                        $items_remote = $this->getItemsRemote($folder_remote . '/' . $item->name);
                                        if (!$items_remote) {
                                                return false;
                                        }

                                        //call recursive function
                                        if (!$this->transfer($folder_remote . '/' . $item->name, $folder_local . '/' . $item->name, $items_remote)) {
                                                return false;
                                        }
                                }
                        }
                }

                return true;
        }

}
