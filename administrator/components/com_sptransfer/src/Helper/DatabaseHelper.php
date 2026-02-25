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

namespace Joomla\Component\Sptransfer\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\Component\Sptransfer\Administrator\Database\DatabaseDriver;
use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;

/**
 * Description of DatabaseHelper
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
abstract class DatabaseHelper {
        
        /**
	 * Global source database object
	 *
	 * @var         DatabaseDriver
	 */
	public static $source_database = null;
        
        /**
	 * Global destination database object
	 *
	 * @var         DatabaseDriver
	 */
	public static $destination_database = null;
        
        /**
         *
         * @var RuntimeException exception after connection test
         */
        public static $exc;
        
        /**
	 * Get the source database object.
	 *
	 * Returns the global {@link DatabaseDriver} object, only creating it if it doesn't already exist.
	 *
	 * @return  DatabaseDriver
	 *
	 * @see         DatabaseDriver
	 */
	public static function getSourceDbo()
	{
		if (!self::$source_database)
		{
			self::$source_database = self::createSourceDbo();
		}

		return self::$source_database;
	}
        
        /**
	 * Create the source database object
	 *
	 * @return  DatabaseDriver
	 *
	 * @see         DatabaseDriver
	 */
	protected static function createSourceDbo()
	{
                $conf = ComponentHelper::getParams('com_sptransfer');

                $options_db = [
                        'driver' => $conf->get('driver', 'mysqli'),
                        'host' => $conf->get('host', 'localhost'),
                        'user' => $conf->get('source_user_name', ''),
                        'password' => $conf->get('source_password', ''),
                        'database' => $conf->get('source_database_name', ''),
                        'prefix' => self::modPrefix($conf->get('source_db_prefix', '')),
                ];

                try {
                        $db = DatabaseDriver::getInstance($options_db);
                } catch (\RuntimeException $exc) {
                        if (!headers_sent()) {
                                header('HTTP/1.1 500 Internal Server Error');
                        }

                        exit('Database Error: ' . $exc->getMessage());
                }
                
		return $db;
	}
        
        /**
	 * Get the destination database object.
	 *
	 * Returns the global {@link DatabaseDriver} object, only creating it if it doesn't already exist.
	 *
	 * @return  DatabaseDriver
	 *
	 * @see         DatabaseDriver
	 */
	public static function getDestinationDbo()
	{
		if (!self::$destination_database)
		{
			self::$destination_database = self::createDestinationDbo();
		}

		return self::$destination_database;
	}
        
        /**
	 * Create the destination database object
	 *
	 * @return  DatabaseDriver
	 *
	 * @see         DatabaseDriver
	 */
	protected static function createDestinationDbo()
	{
                $conf = Factory::getConfig();

		$host = $conf->get('host');
		$user = $conf->get('user');
		$password = $conf->get('password');
		$database = $conf->get('db');
		$prefix = $conf->get('dbprefix');
		$driver = $conf->get('dbtype');

		$options = array('driver' => $driver, 'host' => $host, 'user' => $user, 'password' => $password, 'database' => $database, 'prefix' => $prefix);

		try
		{
			$db = DatabaseDriver::getInstance($options);
		}
		catch (\RuntimeException $e)
		{
			if (!headers_sent())
			{
				header('HTTP/1.1 500 Internal Server Error');
			}

			exit('Database Error: ' . $e->getMessage());
		}
                
		return $db;
	}
        
        /**
         * Put underscore in the prefix if not present
         *
         * @param   string  $prefix  The prefix name
         *
         * @return  string  The prefix name
         *
         */
        public static function modPrefix($prefix) {
                if (!strpos($prefix, '_')) {
                        $prefix = $prefix . '_';
                }
                return $prefix;
        }

        /**
         * Test if the connection is live
         *
         * @return  boolean True in success, or false in failure
         *
         */
        public static function ping($show_error = true) {
                //Check connection        
                $query = "SELECT id from #__users";
                $db = self::getSourceDbo();
                try {
                        $db->setQuery($query);
                        $db->execute();
                } catch (\RuntimeException $exc) {
                        if ($show_error) {
                                Factory::getApplication()->enqueueMessage(Text::sprintf('COM_SPTRANSFER_MSG_ERROR_CONNECTION_DB', $exc->getCode(), $exc->getMessage()), 'error');
                        }
                        self::$exc = $exc;
                        return false;
                }

                if ($show_error) {
                        Factory::getApplication()->enqueueMessage(Text::_('COM_SPTRANSFER_MSG_SUCCESS_CONNECTION'), 'message');
                }
                return true;
        }
        
}
