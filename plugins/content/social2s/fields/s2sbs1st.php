<?php
/**
 * @Copyright
 * @package     Field - S2s Order
 * @author      anton {@link http://www.dibuxo.com}
 * @version     Joomla! 3.x - 1.0.24
 * @date        Created on 09-09-2013
 * @link        Project Site {@link http://dibuxo.com}
 *
 * @license GNU/GPL
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

use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('JPATH_PLATFORM') or die;

class JFormFieldS2sbs1st extends FormField
{
    protected $type = 's2sbs1st';

	public function getLabel() {
		// code that returns HTML that will be shown as the label
		$initial = strtolower($this->element['initial']);
		$initial = '';
		return $initial;
	}

    protected function getInput()
    {
        

        $id = ($this->element['id'] === NULL) ? '' : strtolower($this->element['id']);
        $mode = ($this->element['mode'] === NULL) ? '' : strtolower($this->element['mode']);

        $initial = ($this->element['initial'] === NULL) ? '' : strtolower($this->element['initial']); 
        $label = ($this->element['label'] === NULL) ? '' : strtolower($this->element['label']);
        $slide = ($this->element['slide'] === NULL) ? '' : strtolower($this->element['slide']);
        $acordeon = ($this->element['acordeon'] === NULL) ? '' : strtolower($this->element['acordeon']);

        $active = ($this->element['active'] === NULL) ? '' : strtolower($this->element['active']);


        if($initial=='true'){
            //return JHtml::_('bootstrap.startAccordion', $acordeon, array('active' => $active));
            return HTMLHelper::_('bootstrap.startAccordion', $acordeon, array('active' => $active));

        }elseif($initial=='slide'){
            $slider = HTMLHelper::_('bootstrap.addSlide', $acordeon, Text::_($label), $slide);
            return $slider;
            
        }elseif($initial=='end'){
            $end = HTMLHelper::_('bootstrap.endSlide');
            return $end;

        }elseif($initial=='superend'){

            $superend = HTMLHelper::_('bootstrap.endAccordion');
            return $superend;

        }

  


    }




}
