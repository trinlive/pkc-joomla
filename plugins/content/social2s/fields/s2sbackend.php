<?php
/**
 * @Copyright
 * @package     Field - backend 
 * @author      anton {@link https://jtotal.org}
 * @version     Joomla! 3.0 & 4.0 - 4.0.124
 * @date        Created on 09-09-2018
 * @link        Project Site {@link https://jtotal.org}
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

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Version;


defined('JPATH_PLATFORM') or die;

class JFormFieldS2sBackend extends FormField
{
    protected $type = 's2sbackend';

    protected function getLabel(){
        //return "<strong>License</strong>";
    }

    protected function getInput()
    {
     

        $field_set = $this->form->getFieldset();

        //$field_value='<div class="alert alert-success">'.JText::_('SOCIAL2S_FIELD_LICENSE_OK').'</div>';
        $doc = Factory::getDocument();
        $plugin_path = URI::root().'plugins/content/social2s';
        $media_path = URI::root().'media/plg_social2s';

        $doc->addStyleSheet($media_path.'/css/s2sfont.min.css', 'text/css');
    

        $version = new Version();
        $jversion = substr($version->getShortVersion(), 0, 1);

        $doc->addScriptdeclaration('var jversion="' . $jversion . '";');

        $params  = $this->form->getValue('params');
        $debug = $params->s2s_debug;


        //JS
        if($debug){
            $doc->addScript($media_path.'/js/s2sv4_backend.js');
        }else{
            $doc->addScript($media_path.'/js/s2sv4_backend.min.js');
        }
        //CSS
       

  
        //Specifics
        //V4.X
        if(version_compare($version->getShortVersion(), '4.0', 'ge')){
           
            $app = Factory::getApplication()->getDocument();
            $wa  = $app->getWebAssetManager();
             
            $wa->registerStyle('s2sbackendj4.css', $media_path.'/css/s2sv4_backendj4.css', [], []);
                
            $wa->getAsset('style', 's2sbackendj4.css');

            $wa->useStyle('s2sbackendj4.css');

        //V3.X
        }elseif(version_compare($version->getShortVersion(), '3', 'ge')){
            HTMLHelper::_('jquery.framework');
  
            $doc->addStyleSheet($media_path.'/css/s2sv4_backend.css', 'text/css');
            $doc->addStyleSheet('https://use.fontawesome.com/releases/v5.7.0/css/all.css', 'text/css');
        }

        $field_value = '';

        return $field_value;
    }

}
