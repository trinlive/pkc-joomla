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

namespace Joomla\Component\Sptransfer\Administrator\View\Logs;

defined('_JEXEC') or die;

use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\CMS\MVC\View\ListView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Toolbar\Toolbar;

/**
 * Description of HtmlView
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class HtmlView extends BaseHtmlView {
        
        /**
	 * Constructor
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
        public function __construct(array $config) {
                $config['option'] = 'com_sptransfer';
                return parent::__construct($config);
        }
        
        /**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
        public function display($tpl = null) {
                return parent::display($tpl);
        }

        /**
         * Add the page title and toolbar.
         */
        protected function addToolbar() {
                require_once JPATH_COMPONENT . '/helpers/sptransfer.php';

                $canDo = SptransferHelper::getActions();

                ToolbarHelper::title(Text::_('COM_SPTRANSFER_TABLES_TITLE'), 'install.png');

                if ($canDo->get('core.admin')) {
                        $bar = ToolBar::getInstance('toolbar');
                        if ($canDo->get('core.delete')) {
                                $bar->appendButton('Confirm', 'COM_SPTRANSFER_CONFIRM_MSG', 'delete', 'COM_SPTRANSFER_LOG_DELETE_INDIVIDUAL', 'logs.delete_ind', true);
                                $bar->appendButton('Confirm', 'COM_SPTRANSFER_CONFIRM_MSG', 'delete', 'COM_SPTRANSFER_LOG_DELETE_MASS', 'logs.delete', false);
                        }
                        ToolBarHelper::divider();
                        ToolBarHelper::preferences('com_sptransfer');
                }
                $bar = ToolBar::getInstance('toolbar');
                ToolbarHelper::help(NULL, FALSE, "https://www.kainotomo.com/products/sp-transfer/documentation");
        }
        
}
