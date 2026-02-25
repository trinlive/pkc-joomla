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

/**
 * Description of StructuresHelper
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class FtpOptions {
        
        /**
         * FTP host name or IP
         * 
         * @var string Host Name
         */
        public $host = 'localhost';
        
        /**
         * FTP port. Default 21 for non SSL and 22 for SSLS
         * 
         * @var int Port
         */
        public $port = 21;
        
        /**
         * Connection type.
         * 
         * @var bool SSL
         */
        public $ssl = false;
        
        /**
         *
         * @var string user name
         */
        public $user = '';
        
        /**
         *
         * @var string user password
         */
        public $pass = '';
        
        /**
         *
         * @var string starting root path
         */
        public $root = '/';
        
        /**
         * Replace existing files, or not.
         * 
         * @var bool replace
         */
        public $replace = true;
}
