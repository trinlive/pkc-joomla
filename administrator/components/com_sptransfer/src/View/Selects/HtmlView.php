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

namespace Joomla\Component\Sptransfer\Administrator\View\Selects;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

/**
 * View class for a list of articles.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView {

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
	 * Form object for search filters
	 *
	 * @var  \JForm
	 */
	public $filterForm;

	/**
	 * The active search filters
	 *
	 * @var  array
	 */
	public $activeFilters;

        /**
         * Display the view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
         *
         * @return  mixed  A string if successful, otherwise an Error object.
         */
        public function display($tpl = null) {
                $this->items = $this->get('Items');
                $this->pagination = $this->get('Pagination');
                $this->state = $this->get('State');
                $this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
                
                $this->name = $this->state->get('name');
                $this->extension_name = $this->state->get('extension_name');
                $this->cid = $this->state->get('cid');
                
                $this->addJS();

                parent::display($tpl);
        }
        
        /**
         * Add JS in document
         */
        private function addJS() 
        {
                $doc = Factory::getDocument();
                $doc->addScript(Uri::root() . 'media/com_sptransfer/js/selects.js');
        }

}
