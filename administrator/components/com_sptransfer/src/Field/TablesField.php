<?php

/*
 * Copyright (C) 2017 KAINOTOMO PH LTD <info@kainotomo.com>
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

namespace Joomla\Component\Sptransfer\Administrator\Field;

defined('_JEXEC') or die;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Factory;

/**
 * Tables Field class for the SP Transfer component
 */
class TablesField extends ListField {

        /**
         * The form field type.
         *
         * @var		string
         * @since	1.6
         */
        protected $type = 'Tables';

        /**
         * Method to get the field options.
         *
         * @return	array	The field option objects.
         * @since	1.6
         */
        public function getOptions() {
                // Initialize variables.
                $options = array();

                $db = Factory::getDbo();
                $query = $db->getQuery(true);

                $query->select("id As value, CONCAT(extension_name,', ',name) As text");
                $query->from('#__sptransfer_tables AS a');
                $query->order('a.ordering');

                // Get the options.
                $db->setQuery($query);

                try {
                        $options = $db->loadObjectList();
                } catch (\RuntimeException $exc) {
                        Factory::getApplication()->enqueueMessage($exc->getMessage(), 'warning');
                }

                // Merge any additional options in the XML definition.
                $options = array_merge(parent::getOptions(), $options);

                return $options;
        }

}
