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

namespace Joomla\Component\Sptransfer\Administrator\Database;

defined('_JEXEC') or die;

use Joomla\Component\Sptransfer\Administrator\Database\DatabaseFactory;

/**
 * Description of DatabaseDriver
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
abstract class DatabaseDriver extends \Joomla\Database\DatabaseDriver {
        
        /**
	 * Method to return a DatabaseDriver instance based on the given options.
	 *
	 * There are three global options and then the rest are specific to the database driver.
	 *
	 * - The 'driver' option defines which DatabaseDriver class is used for the connection -- the default is 'mysqli'.
	 * - The 'database' option determines which database is to be used for the connection.
	 * - The 'select' option determines whether the connector should automatically select the chosen database.
	 *
	 * Instances are unique to the given options and new objects are only created when a unique options array is
	 * passed into the method.  This ensures that we don't end up with unnecessary database connection resources.
	 *
	 * @param   array  $options  Parameters to be passed to the database driver.
	 *
	 * @return  DatabaseDriver
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public static function getInstance(array $options = [])
	{
		// Sanitize the database connector options.
		$options['driver']   = isset($options['driver']) ? preg_replace('/[^A-Z0-9_\.-]/i', '', $options['driver']) : 'mysqli';
		$options['database'] = $options['database'] ?? null;
		$options['select']   = $options['select'] ?? true;
		$options['factory']  = $options['factory'] ?? new DatabaseFactory;
		$options['monitor']  = $options['monitor'] ?? null;

		// Get the options signature for the database connector.
		$signature = md5(serialize($options));

		// If we already have a database connector instance for these options then just use that.
		if (empty(self::$instances[$signature]))
		{
			// Set the new connector to the global instances based on signature.
			self::$instances[$signature] = $options['factory']->getDriver($options['driver'], $options);
		}

		return self::$instances[$signature];
	}
}
