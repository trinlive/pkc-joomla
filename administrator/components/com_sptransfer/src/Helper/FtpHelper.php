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

use FtpClient\FtpClient;
use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;

/**
 * Description of FtpHelper
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
abstract class FtpHelper {
        
        /**
         *
         * @var FtpClient\FtpClient
         */
        public static $ftp_client;

        /**
         *
         * @var FtpOptions connection data for FTP
         */
        public static $ftp_options;
        
        /**
         *
         * @var RuntimeException exception after connection test
         */
        public static $exc;
        
        /**
	 * Gets the ftp options object
	 *
	 * Returns the global {@link FtpOptions} object, only creating it if it doesn't already exist.
	 *
	 * @return  FtpOptions
	 *
	 * @see         FtpOptions
	 */
	public static function getFtpOptions()
	{
		if (!self::$ftp_options)
		{
			self::$ftp_options = self::createFtpOptions();
		}

		return self::$ftp_options;
	}
        
        /**
	 * Create the ftp options object
	 *
	 * @return  FtpOptions
	 *
	 * @see         FtpOptions
	 */
	protected static function createFtpOptions()
	{
                // setup source database connection
                $conf = ComponentHelper::getParams('com_sptransfer');

                //setup FTP connection
                $options_ftp = new FtpOptions();
                $options_ftp->host = $conf->get("ftp_host", 'localhost');
                $options_ftp->port = $conf->get("ftp_port", '21');
                $options_ftp->ssl = $conf->get("ftp_ssl", '0');
                $options_ftp->user = $conf->get("ftp_user", '');
                $options_ftp->pass = $conf->get("ftp_pass", '');
                $options_ftp->root = str_replace('//', '/', $conf->get("ftp_root", '/'));
                $options_ftp->replace = $conf->get("replace_files", 1); //1 - no, 0 - yes
                return $options_ftp;
	}
        
        /**
	 * Gets the ftp client object
	 *
	 * Returns the global {@link FtpClient} object, only creating it if it doesn't already exist.
	 *
	 * @return  FtpClient
	 *
	 * @see         FtpClient
	 */
	public static function getFtpClient()
	{
		if (!self::$ftp_client)
		{
			self::$ftp_client = self::createFtpClient();
		}

		return self::$ftp_client;
	}
        
        /**
	 * Create the ftp client object
	 *
	 * @return  FtpClient
	 *
	 * @see         FtpClient
	 */
	protected static function createFtpClient()
	{
                return new FtpClient();
	}
        
        /**
         * Test the ftp connection with source site
         * 
         * @param boolean $show_error
         * @return boolean
         * @throws \Exception
         */
        public static function ping($show_error = true) {
                $ftp = self::getFtpClient();
                $options = self::getFtpOptions();

                // Test the connection and try to log in
                try {
                        $ftp->connect($options->host, (bool) $options->ssl, $options->port, 5);
                        $ftp->login($options->user, $options->pass);
                        $ftp->chdir($options->root);
                        $items = $ftp->scanDir();      
                        if (empty($items)) {
                                $ftp->pasv(true);
                                $items = $ftp->scanDir();      
                                if (empty($items)) {
                                        throw new \Exception('Path not in a Joomla directory', 403);
                                }
                        }
                } catch (\Exception $exc) {
                        if ($show_error) {
                                Factory::getApplication()->enqueueMessage($exc->getMessage(), 'error');
                        }
                        self::$exc = $exc;
                        return false;
                }

                if ($show_error) {
                        Factory::getApplication()->enqueueMessage(Text::_('COM_SPTRANSFER_MSG_SUCCESS_FTP_CONNECTION'), 'message');
                }

                return true;
        }
        
}
