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

namespace Joomla\Component\Sptransfer\Administrator\View\Files;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\DatabaseHelper;
use Joomla\Component\Sptransfer\Administrator\Helper\FtpHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\Uri\Uri;

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
     * An array of remote files
     * 
     * @var array
     */
    protected $items_remote;

    /**
     * An array of local files
     * 
     * @var array
     */
    protected $items_local;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    public function display($tpl = null)
    {
        SptransferHelper::addSubmenu('tables');

        // Get data from the model
        $this->dbTestConnection = true;
        //$this->pathConnection = $this->get('PathConnection');
        $this->ftpConnection = FtpHelper::ping(FALSE);

        // Do not allow cache
        Factory::getApplication()->allowCache(FALSE);

        // Get data from the model
        $this->items_remote = $this->get('ItemsRemote');
        $this->items_local = $this->get('ItemsLocal');

        // Set the toolbar
        $this->addToolBar();
        $this->sidebar = \JHtmlSidebar::render();

        // Set the document
        $this->addJS();

        //set folders
        $this->folder_remote = Factory::getApplication()->input->getHtml('folder_remote');
        $this->folder_local = Factory::getApplication()->input->getHtml('folder_local');

        return parent::display($tpl);
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar()
    {
        $canDo = SptransferHelper::getActions();

        ToolbarHelper::title(Text::_('COM_SPTRANSFER_TABLES_TITLE'), 'install.png');

        if ($canDo->get('core.admin'))
        {
            $bar = Toolbar::getInstance('toolbar');
            $bar->appendButton(
                'Custom', '<joomla-toolbar-button list-selection="">'
                . '<button onclick="KAINOTOMO_submitbutton(\'files.transfer\')" class="btn btn-primary" disabled>'
                . '<span class="fas fa-copy" aria-hidden="true"></span>'
                . Text::_('COM_SPTRANSFER_TRANSFER') . '</button>'
                . '</joomla-toolbar-button>'
            );
            ToolbarHelper::divider();
            ToolbarHelper::preferences('com_sptransfer');
        }
        ToolbarHelper::help(NULL, FALSE, "https://www.kainotomo.com/products/sp-transfer/documentation");
    }

    private function addJS()
    {
        $doc = Factory::getDocument();

        $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/files.js');
        $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/files_2.js');
        $doc->addScript(\JURI::root() . 'media/com_sptransfer/js/submit.js');
    }

}
