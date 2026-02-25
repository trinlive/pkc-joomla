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

namespace Joomla\Component\Sptransfer\Administrator\View\Databases;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Uri\Uri;

/**
 * View class for a list of articles.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView
{

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
        public function display($tpl = null)
        {
                SptransferHelper::addSubmenu('databases');

                // Get data from the model
                $this->dbTestConnection = DatabaseHelper::ping(FALSE);
                //$this->pathConnection = $this->get('PathConnection');
                $this->ftpConnection = false;

                if ($this->dbTestConnection) {
                        $this->items = $this->get('Items');
                        $this->pagination = $this->get('Pagination');
                        $this->state = $this->get('State');
                        $this->filterForm    = $this->get('FilterForm');
                        $this->activeFilters = $this->get('ActiveFilters');
                        $this->addToolbar();
                        $this->sidebar = \JHtmlSidebar::render();

                        //Set JavaScript
                        $this->addJS();

                        return parent::display($tpl);
                }

                Factory::getApplication()->enqueueMessage(Text::_('COM_SPTRANSFER_MSG_ERROR_CONNECTION_DB2'), 'error');
        }

        /**
         * Add the page title and toolbar.
         *
         * @return  void
         *
         * @since   1.6
         */
        protected function addToolbar()
        {
                $canDo = SptransferHelper::getActions();

                $bar = \Joomla\CMS\Toolbar\Toolbar::getInstance('toolbar');

                ToolbarHelper::title(Text::_('COM_SPTRANSFER_TABLES_TITLE'), 'stack article');

                if ($canDo->get('core.admin')) {
                        if ($this->dbTestConnection) {
                                if (!empty($this->items)) {
                                        $bar->appendButton(
                                                'Custom',
                                                '<joomla-toolbar-button list-selection="">'
                                                        . '<button onclick="KAINOTOMO_submitbutton(\'databases.transfer\')" class="btn btn-primary" disabled>'
                                                        . '<span class="fas fa-copy" aria-hidden="true"></span>'
                                                        . Text::_('COM_SPTRANSFER_TRANSFER') . '</button>'
                                                        . '</joomla-toolbar-button>'
                                        );
                                }
                                ToolbarHelper::divider();
                        }
                        ToolBarHelper::preferences('com_sptransfer');
                }

                ToolbarHelper::help(NULL, FALSE, "https://www.kainotomo.com/products/sp-upgrade/documentation");
        }

        private function addJS()
        {
                //Handle chosed items
                $rows = "";
                foreach ($this->items as $item) {
                        $rows .= "rows[" . $item->id . "]='" . $item->prefix . "_" . $item->name . "';\n";
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

                $doc->addScript(Uri::root() . 'media/com_sptransfer/js/core.js');
                $doc->addScript(Uri::root() . 'media/com_sptransfer/js/submit.js');
                $doc->addScript(Uri::root() . 'media/com_sptransfer/js/selects.js');
        }
}
