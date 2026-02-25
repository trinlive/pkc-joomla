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

use Joomla\CMS\Form\Field;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\CMS\Factory;

/**
 * Selects Field class.
 *
 * @since  3.8.0
 */
class SelectsField extends Field\ListField {

        /**
         * The form field type.
         *
         * @var    string
         * @since  3.7.1
         */
        protected $type = 'Selects';
       
        /**
         * Method to get the field options.
         *
         * @return array The field option objects.
         *
         * @throws \Exception
         *
         * @since  3.7.1
         */
        public function getOptions() {
                
                $name = Factory::getApplication()->input->get('name');
                $extension_name = Factory::getApplication()->input->get('extension_name');
                
                $db = DatabaseHelper::getSourceDbo();
                $query = $db->getQuery(true);
                
                $query = 'SHOW COLUMNS FROM #__' . $name;
                
                $db->setQuery($query);
                try {
                        $rows = $db->loadObjectlist();
                } catch (\RuntimeException $e) {
                        Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
                }
                foreach ($rows as $row) {
                        $option = new \stdClass();
                        $option->text = $row->Field;
                        $option->value = $row->Field;
                        $field_names[] = $option;
                }    
                // Merge any additional options in the XML definition.
                $options = array_merge(parent::getOptions(), $field_names);
                return $options;
        }

}
