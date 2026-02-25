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

namespace Joomla\Component\Sptransfer\Administrator\View\Tables;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

/**
 * View class for a list of articles.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView {

        /**
         * Testing database connection
         * 
         * @var bool 
         */
        public $dbTestConnection;

        /**
         * FTP client connection
         * 
         * @var FtpCLient
         */
        public $ftpConnection;

        /**
         * An array of items
         *
         * @var  array
         */
        protected $items;

        /**
         * The pagination object
         *
         * @var  \JPagination
         */
        protected $pagination;

        /**
         * The model state
         *
         * @var  \JObject
         */
        protected $state;

        /**
         * The sidebar markup
         *
         * @var  string
         */
        protected $sidebar;

        /**
         * Array used for displaying the levels filter
         *
         * @return  stdClass[]
         * @since  4.0.0
         */
        protected $f_levels;

        /**
         * Display the view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
         *
         * @return  mixed  A string if successful, otherwise an Error object.
         */
        public function display($tpl = null) {
                SptransferHelper::addSubmenu('tables');

                // Get data from the model
                $this->dbTestConnection = DatabaseHelper::ping(FALSE);
                if (!$this->dbTestConnection) {
                        Factory::getApplication()->enqueueMessage(Text::_('COM_SPTRANSFER_MSG_ERROR_CONNECTION_DB2'), 'error');
                }
                //$this->pathConnection = $this->get('PathConnection');
                $this->ftpConnection = true;

                $this->items = $this->get('Items');
                $this->pagination = $this->get('Pagination');
                $this->state = $this->get('State');

                $this->addToolbar();

                //Set JavaScript
                $this->addJS();

                return parent::display($tpl);
        }

        /**
         * Add the page title and toolbar.
         *
         * @return  void
         *
         * @since   1.6
         */
        protected function addToolbar() {
                $canDo = SptransferHelper::getActions();

                $bar = Toolbar::getInstance('toolbar');

                ToolbarHelper::title(Text::_('COM_SPTRANSFER_TABLES_TITLE'), 'copy');

                if ($canDo->get('core.admin')) {
                        if ($this->dbTestConnection) {
                                $bar->appendButton(
                                        'Custom', '<joomla-toolbar-button>'
                                        . '<button onclick="KAINOTOMO_submitbutton(\'tables.transfer_all\')" class="btn btn-primary">'
                                        . '<span class="fas fa-arrows-alt" aria-hidden="true"></span>'
                                        . Text::_('COM_SPTRANSFER_TRANSFER_ALL') . '</button>'
                                        . '</joomla-toolbar-button>'
                                    );
                                $bar->appendButton(
                                            'Custom', '<joomla-toolbar-button list-selection="">'
                                            . '<button onclick="KAINOTOMO_submitbutton(\'tables.transfer\')" class="btn btn-primary" disabled>'
                                            . '<span class="fas fa-copy" aria-hidden="true"></span>'
                                            . Text::_('COM_SPTRANSFER_TRANSFER') . '</button>'
                                            . '</joomla-toolbar-button>'
                                        );
                                $bar->appendButton(
                                            'Custom', '<joomla-toolbar-button list-selection="">'
                                            . '<button onclick="KAINOTOMO_submitbutton(\'tables.fix\')" class="btn btn-primary" disabled>'
                                            . '<span class="fas fa-cog" aria-hidden="true"></span>'
                                            . Text::_('COM_SPTRANSFER_FIX') . '</button>'
                                            . '</joomla-toolbar-button>'
                                        );
                                ToolbarHelper::divider();
                        }
                        ToolbarHelper::preferences('com_sptransfer');
                }

                ToolbarHelper::help(NULL, FALSE, "https://www.kainotomo.com/products/sp-transfer/documentation");
        }

        private function addJS() {
                //Handle chosed items
                $rows = "";
                foreach ($this->items as $item) {
                        $rows .= "rows[" . $item->id . "]='" . $item->extension_name . "_" . $item->name . "';\n";
                }

                //Choose items
                $js = "
		function jSelectItem(cid, prefix, name, id_arr) {

                        
                        var input_ids = 'input_ids'+cid;
                        var input_id;
                        var chklength = id_arr.length;
                        for(k=0;k<chklength;k++) {
                            input_id = document.getElementById(input_ids);
                            if (input_id.value == '') {
                                input_id.value = id_arr[k];
                            } else {
                                input_id.value = input_id.value + ',' + id_arr[k];
                            }                
                        }
                }";

                $doc = Factory::getDocument();
                $doc->addScriptDeclaration($js);

                $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/core.js');
                $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/submit.js');
                $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/selects.js');
        }

}
