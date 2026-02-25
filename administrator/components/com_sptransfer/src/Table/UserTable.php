<?php

/*
 * Copyright (C) 2020 Panayiotis Halouvas <phalouvas@kainotomo.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Joomla\Component\Sptransfer\Administrator\Table;

/**
 * Override default Joomla user table of UserTable
 *
 * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
 */
class UserTable extends \Joomla\CMS\Table\User
{
    /**
     * Method to bind the user, user groups, and any other necessary data.
     *
     * @param   array  $array   The data to bind.
     * @param   mixed  $ignore  An array or space separated list of fields to ignore.
     *
     * @return  boolean  True on success, false on failure.
     *
     * @since   1.7.0
     */
    public function bind($array, $ignore = '')
    {
        $return = parent::bind($array, $ignore);

        if ($return && empty($this->groups) && !empty($array['groups']))
        {
            $this->groups = $array['groups'];
        }

        return $return;
    }

}
