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

namespace Joomla\Component\Sptransfer\Administrator\Table;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Event\DispatcherInterface;
use Joomla\CMS\Language\Text;

/**
 * Log Table class.
 *
 * @since  1.6
 */
class LogTable extends Table {

        /**
         *
         * @var stdClass Storing item for logging 
         */
        public $task;
        
        /**
         *
         * @var Joomla\CMS\Filesystem\Stream File for logging 
         */
        private $stream;

        /**
         * Constructor
         *
         * @param   DatabaseDriver        $db          Database connector object
         * @param   ?DispatcherInterface  $dispatcher  Event dispatcher for this table
         *
         * @since   1.6
         */
        public function __construct(DatabaseDriver $db, DispatcherInterface $dispatcher = null)
        {

                /*
                // Open and initialize log file
                $log_path = Factory::getApplication()->get('log_path') . '/com_sptransfer.log.php';
                $this->stream = new Stream();
                $this->stream->open($log_path, 'w+');
                Log::addLogger(
                        array('text_file' => 'com_sptransfer.log.php'), Log::ALL, array('com_sptransfer')
                );
                 * 
                 */

                parent::__construct('#__sptransfer_log', 'id', $db);
        }
        
        /**
         * Close the file
         */
        public function __destruct() {
                //$this->stream->close();
        }

        /**
         * Method to store a row in the database from the Table instance properties.
         *
         * If a primary key value is set the row with that primary key value will be updated with the instance property values.
         * If no primary key value is set a new row will be inserted into the database with the properties from the Table instance.
         *
         * @param   boolean  $updateNulls  True to update fields even if they are null.
         *
         * @return  boolean  True on success.
         *
         */
        public function store($updateNulls = false) {
                $this->created = date("Y-m-d H:i:s");
                //$this->log();
                return parent::store($updateNulls);
        }

        /**
         * 
         */
        private function log() {                
                $message = new \stdClass();
                $message->type = $this->task->extension_name . '_'. $this->task->name;
                $message->state = Text::_('COM_SPTRANSFER_STATE_LOG_' . $this->state);
                $message->source_id = $this->source_id;
                $message->destination_id = $this->destination_id;
                $message->note = $this->note;
                $message->date = $this->created;
                $message_json = json_encode($message) . "\r\n";
                $this->stream->write($message_json);
        }

}
