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

use Joomla\Database\DatabaseInterface;
use Joomla\Database\Exception\ConnectionFailureException;
use Joomla\Database\Exception\UnsupportedAdapterException;
use RuntimeException;

/**
 * Description of DatabaseFactory
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class DatabaseFactory extends \Joomla\Database\DatabaseFactory{
        
        /**
	 * Method to return a database driver based on the given options.
	 *
	 * There are three global options and then the rest are specific to the database driver. The 'database' option determines which database is to
	 * be used for the connection. The 'select' option determines whether the connector should automatically select the chosen database.
	 *
	 * @param   string  $name     Name of the database driver you'd like to instantiate
	 * @param   array   $options  Parameters to be passed to the database driver.
	 *
	 * @return  DatabaseInterface
	 *
	 * @since   1.0
	 * @throws  Exception\UnsupportedAdapterException if there is not a compatible database driver
	 */
	public function getDriver(string $name = 'mysqli', array $options = []): DatabaseInterface
	{
		// Sanitize the database connector options.
		$options['driver']   = preg_replace('/[^A-Z0-9_\.-]/i', '', $name);
		$options['database'] = $options['database'] ?? null;
		$options['select']   = $options['select'] ?? true;

		// Derive the class name from the driver.
		$class = __NAMESPACE__ . '\\' . ucfirst(strtolower($options['driver'])) . '\\' . ucfirst(strtolower($options['driver'])) . 'Driver';

		// If the class still doesn't exist we have nothing left to do but throw an exception.  We did our best.
		if (!class_exists($class))
		{
			throw new UnsupportedAdapterException(sprintf('Unable to load Database Driver: %s', $options['driver']));
		}

		// Create our new DatabaseDriver connector based on the options given.
		try
		{
			return new $class($options);
		}
		catch (RuntimeException $e)
		{
			throw new ConnectionFailureException(sprintf('Unable to connect to the Database: %s', $e->getMessage()), $e->getCode(), $e);
		}
	}
}
