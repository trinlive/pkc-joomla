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

namespace Joomla\Component\Sptransfer\Administrator\Helper;

// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * Sptransfer component helper.
 */
class SptransferHelper extends ContentHelper {

        /**
         * Configure the Linkbar.
         */
        public static function addSubmenu($submenu) {
                
                \JHtmlSidebar::addEntry(
                        Text::_('COM_SPTRANSFER_TEST_CONNECTION_SUBMENU'), 'index.php?option=com_sptransfer&view=cpanel', $submenu == 'cpanel'
                );
                \JHtmlSidebar::addEntry(
                        Text::_('COM_SPTRANSFER_TABLES_SUBMENU'), 'index.php?option=com_sptransfer&view=tables', $submenu == 'tables'
                );
                \JHtmlSidebar::addEntry(
                        Text::_('COM_SPTRANSFER_DATABASE_SUBMENU'), 'index.php?option=com_sptransfer&view=databases', $submenu == 'databases'
                );
                \JHtmlSidebar::addEntry(
                        Text::_('COM_SPTRANSFER_FILES_SUBMENU'), 'index.php?option=com_sptransfer&view=files', $submenu == 'files'
                );
                \JHtmlSidebar::addEntry(
                        Text::_('COM_SPTRANSFER_HISTORY_SUBMENU'), 'index.php?option=com_sptransfer&view=logs', $submenu == 'logs'
                );
        }

        /**
         * Get the actions
         */
        public static function getActions($component = '', $section = '', $id = 0) {
                $user = Factory::getUser();
                $result = new \JObject;

                if (empty($id)) {
                        $assetName = 'com_sptransfer';
                } else {
                        $assetName = 'com_sptransfer.tables.' . (int) $id;
                }

                $actions = array(
                    'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
                );

                foreach ($actions as $action) {
                        $result->set($action, $user->authorise($action, $assetName));
                }

                return $result;
        }

        public static function parseSize($size) {
                if ($size < 1024) {
                        return Text::sprintf('COM_SPTRANSFER_FILESIZE_BYTES', $size);
                } elseif ($size < 1024 * 1024) {
                        return Text::sprintf('COM_SPTRANSFER_FILESIZE_KILOBYTES', sprintf('%01.2f', $size / 1024.0));
                } else {
                        return Text::sprintf('COM_SPTRANSFER_FILESIZE_MEGABYTES', sprintf('%01.2f', $size / (1024.0 * 1024)));
                }
        }

        /**
         * Returns valid contexts for fields
         *
         * @return  array
         *
         * @since   3.7.0
         */
        public static function getContexts() {

                $contexts = array(
                    'com_sptransfer.all' => Text::_('JALL'),
                    'com_content.article' => Text::_('com_content') . ' -> ' . Text::_('com_content_content'),
                    'com_content.categories' => Text::_('com_content') . ' -> ' . Text::_('com_content_categories'),
                    'com_users.user' => Text::_('com_users') . ' -> ' . Text::_('com_users_users'),
                    'com_contact.contact' => Text::_('com_contact') . ' -> ' . Text::_('COM_CONTACT'),
                    'com_contact.mail' => Text::_('com_contact') . ' -> ' . Text::_('JGLOBAL_EMAIL'),
                    'com_contact.categories' => Text::_('com_contact') . ' -> ' . Text::_('COM_CONTACT_CATEGORIES')
                );

                return $contexts;
        }
        
        /**
         * Get the extension package
         * 
         * @param string $element
         * @return \Joomla\Registry\Registry The manifest
         */
        public static function getManifest($element = 'pkg_sptransfer') {
                $extension = new \Joomla\CMS\Table\Extension(Factory::getDbo());
                $extension->load(array('element' => $element));
                $manifest = new \Joomla\Registry\Registry($extension->manifest_cache);
                return $manifest;               
        }
}
