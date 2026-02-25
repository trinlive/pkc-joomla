<?php
/**
 * @Copyright
 * @package     Field - license check
 * @author      anton {@link http://www.dibuxo.com}
 * @version     Joomla! 3.x - 3.4.7
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

defined('JPATH_PLATFORM') or die;

class JFormFieldS2sLicenseCheck extends JFormField
{
    protected $type = 's2slicensecheck';
    private $tiempo  = '';

    protected function getLabel(){
        return "<strong>License</strong>";
    } 

    protected function getInput()
    {

        $field_set = $this->form->getFieldset();
     
        $license_email = $field_set['jform_params_s2s_license_email']->value;

        //sesion para no llamar cada vez
        $session = JFactory::getSession();
        $valida_sesion = $session->get('s2slicensecheck');

        //tests
        //$session->clear("s2slicensecheck");
        //$session->clear("s2semailcheck");
        //$session->clear("s2stime");


        //var_dump($valida_sesion);

        $valida = $this->_checkLicense($license_email);

        if($valida){
            $field_value = '';
            $tiempo = (int) $session->get('s2stime');
            //var_dump($tiempo);
            //var_dump($tiempo);
            if($tiempo !== NULL){
                if($tiempo <= 744 && $tiempo >= 0){
                    $field_value.='<div class="alert alert-warning">'.$this->tiempo.JText::_('SOCIAL2S_ABOUT_TO_END').'</div>';
                }elseif($tiempo >= -1400 && $tiempo <= 0){
                    $field_value.='<div class="alert alert-danger">'.$this->tiempo.JText::_('SOCIAL2S_END_OFFER').'</div>';
                }
            }else{
                //var_dump($tiempo);
            }

            $params = $this->form->getValue('params');

            $count_error = 0;

            $field_value .='<div class="alert alert-success">
                <input type="hidden" class="s2s_backend_license_js_check" name="s2s_backend_license_js_check" value="1"/>
                '.JText::_('SOCIAL2S_FIELD_LICENSE_OK').'<br>'.JText::_('SOCIAL2S_FIELD_LICENSE_OK_SETTINGS_BUTTON').'
                <ul>
                <li>Plugin->Modern behavior';

                if($params->social2s_base == '0'){
                    $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"></i>';
                    $count_error+=1;
                }else{
                    $field_value.= ' <i class="fa fa-check-circle-o "></i>';
                }

            $field_value.= '</li>
                <li>Social Network -> Twitter cards';

                if($params->twitter_cards == '0' || $params->twitter_user == ''){
                    if($params->twitter_user == ''){
                        $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"> missing twitter user</i>';
                        $count_error+=1;
                    }else{
                        $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"></i>';
                        $count_error+=1;
                    }
                }else{
                    $field_value.= ' <i class="fa fa-check-circle-o "></i>';
                }

            $field_value.= '</li>
                <li>Article or Category -> Fill (only in mobile)';

                if($params->s2s_art_fill != '2'){
                    $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"></i>';
                     $count_error+=1;
                }else{
                    $field_value.= ' <i class="fa fa-check-circle-o "></i>';
                }


           $field_value.= '</li>

                <li>Load fast twitter button';

                if($params->twitter_fast_as_light != '1'){
                    $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"></i>';
                     $count_error+=1;
                }else{
                    $field_value.= ' <i class="fa fa-check-circle-o "></i>';
                }


                $field_value.= '</li>

                <li>Remove credits. You supported us enough ;) ';

                if($params->s2s_credits != '0'){
                    $field_value.= ' <i class="fa fa-times-circle-o" style="color:#D21A1A;"></i>';
                     $count_error+=1;
                }else{
                    $field_value.= ' <i class="fa fa-check-circle-o "></i>';
                }


                $field_value.= '</li>

                


                </ul>';

                if($count_error!=0){
                    $field_value.= '<a class="btn btn-success apply_cool_stuff" onclick="apply_cool_stuff();Joomla.submitbutton(\'plugin.apply\')">'.JText::_('SOCIAL2S_APPLY_COOL_STUFF').'</a>';
                }
                
            $field_value.= '</div>';

            
        
         }else{
            //mensaje de alerta y compra
            /*LITE*/
            $params = $this->form->getValue('params');
            $params->social2s_base = '0';
            $params->s2s_stupid_cookie_on = '0';
            $params->s2s_stupid_cookie_on = '0';
            $params->s2s_insert = '0';
            $params->s2s_virtuemart = '0';
            $params->s2s_takefromarticle = '1';
            $params->twitter_follow = '0';
            $params->tumblr_follow = '0';
            $params->s2s_art_fixed = '0';
            $params->s2s_cta_active = '0';
            $params->twitter_cards = '0';
            $params->opengraph_default_image_opt = '0';
            $params->s2s_jevents = '0';
            $params->s2s_order = '0,1,2,3,4,5,6,7,8';
            $params->s2s_og_debug = '0';
            $params->og_skip_min_img = '0';
            $params->twitter_fast_as_light = '0';
            $params->s2s_art_balloon_pos = '0';
            $params->s2s_k2 = '0';
            //$params->s2s_credits = '1';
            $params->facebook_like_count = '0';
            $params->facebook_share_count = '0';
            $params->facebook_total_count = '0';
            $params->pinterest_count = '0';
            $params->linkedin_count = '0';
            $params->gplus_b_count = '0';
            $params->tumblr_count = '0';
            $params->s2s_vk_count = '0';
            $params->opengraph_metadescription = '0';
            $params->twitter_cards_summary = '0';


            if($params->mas_on==2){
                $params->mas_on = 1;
            }


            //count
            if($params->s2s_art_fill==2){
                $params->s2s_art_fill = 0;
            }

            //consulta
            $reparams = $this->form->getValue('params');
    
            $encode_params = json_encode($reparams);
            $db = JFactory::getDBO();
            $query = $db->getQuery(true);
            // Build the query 
            $query->update($db->quoteName('#__extensions'));
            $query->set($db->quoteName('params') . ' = ' . $db->quote((string)$encode_params));
            $query->where($db->quoteName('element') . ' = ' . $db->quote("social2s"));

            // Execute the query
            $db->setQuery($query);
            $db->query();

            //alerta LITE
            $field_value='<div class="alert alert-error">
                        <input type="hidden" class="s2s_backend_license_js_check" name="s2s_backend_license_js_check" value="0"/>
            <h4>'.JText::_('SOCIAL2S_DONATE').'</h4>'.JText::_('SOCIAL2S_DONATE_DESC').'</div>';
        }

        //$field_set = $this->form->getFieldset();
        $field_value .= "";

        return $field_value;
    }

    private function _checkLicense($email){

        $params = $this->form->getValue('params');

        $session = JFactory::getSession();

        if(!$session->get('s2semailcheck')){
            $session->set('s2semailcheck',$email);
        }
        if(!$session->get('s2slicensecheck')){
            $session->set('s2slicensecheck',0);
        }

        $valida = false;

        if($email==""){
            $session->set('s2slicensecheck', 0);
            $session->set('s2semailcheck',$email);
            $valida = false;
        }else{
            $email_session = $session->get('s2semailcheck');

            if($email_session != $email){
                $session->set('s2slicensecheck', 0);
                $session->set('s2semailcheck',$email);

                if($this->_checkHome($email)){

                    $session->set('s2slicensecheck', 1);
                    $valida = true;
                }else{
                    $session->set('s2slicensecheck', 0); 
                    $valida = false;
                }
            }else{

                if($session->get('s2slicensecheck') == 1){
                    $valida = true;
                }else{
                    if($this->_checkHome($email)){
                        $valida = true;
                    }else{
                        $valida = false;
                    }
                }
            }
        }
        return $valida;
    }

    private function _checkHome($email){
        
        $url_check = 'http://soft.dibuxo.com/licenses/social2s/validation_v2.php?email='.$email;

        $session = JFactory::getSession();

        //CURL
        //var_dump(function_exists('curl_init'));
        if(function_exists('curl_init')){
            $session->set('license_validation:', 'CURL');
            return $this->_checkHomeCurl($url_check);
        }else{
        //CURL_FALLBACK
            $session->set('license_validation:', 'fsockopen');
            return $this->_checkHomeCurl_fallback($url_check);
        }
    }

    private function _checkHomeCurl($url_check){

        $session = JFactory::getSession();

        $curl_response = curl_init($url_check);
        curl_setopt($curl_response, CURLOPT_HEADER, 0);
        curl_setopt($curl_response, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_response, CURLOPT_NOSIGNAL, 1);
        curl_setopt($curl_response, CURLOPT_CONNECTTIMEOUT, 5);
        $response = curl_exec($curl_response);
        curl_close($curl_response);
        if($response){
            $exploder_res = explode('|',$response);
            $response = $exploder_res[0];
            $tiempo = $exploder_res[1];
        }else{
             //echo "</br>respuesta KO";
            $session->set('s2slicensecheck', 0);
            return false;
        }

        //echo "</br>la respuesta es:".$response;
        if($response == "OK"){
            //echo "</br>respuesta OK";
            $session->set('s2slicensecheck', 1);
            $session->set('s2stime', $tiempo);
            return true;
        }else{
            //echo "</br>respuesta KO";
            $session->set('s2slicensecheck', 0);
            $session->set('s2stime', $tiempo);
            return false;
        }
    }

    private function _checkHomeCurl_fallback($url){

        $session = JFactory::getSession();

        $response = $this->rest_helper($url);

        if($response){
            //var_dump($response);
            $exploder_res = explode('|',$response);
            $response = $exploder_res[0];
            $tiempo = $exploder_res[1];
            
        }else{
             //echo "</br>respuesta KO";
            $session->set('s2slicensecheck', 0);
            return false;
        }

        //echo "</br>la respuesta es:".$response;
        if($response == "OK"){
            //echo "</br>respuesta OK";
            $session->set('s2slicensecheck', 1);
            $session->set('s2stime', $tiempo);
            return true;
        }else{
            //echo "</br>respuesta KO";
            $session->set('s2slicensecheck', 0);
            $session->set('s2stime', $tiempo);
            return false;
        }
    }


    function rest_helper($url, $params = null, $verb = 'GET', $format = 'html')
    {
      $cparams = array(
        'http' => array(
          'method' => $verb,
          'ignore_errors' => true
        )
      );
      if ($params !== null) {
        $params = http_build_query($params);
        if ($verb == 'POST') {
          $cparams['http']['content'] = $params;
        } else {
          $url .= '?' . $params;
        }
      }

      $context = stream_context_create($cparams);
      $fp = fopen($url, 'rb', false, $context);
      if (!$fp) {
        $res = false;
      } else {
        $res = stream_get_contents($fp);
      }

      if ($res === false) {
        throw new Exception("$verb $url failed: $php_errormsg");
      }

      switch ($format) {
        case 'json':
          $r = json_decode($res);
          if ($r === null) {
            throw new Exception("failed to decode $res as json");
          }
          return $r;
        case 'html':
          $r = $res;
          if ($r === null) {
            throw new Exception("failed to decode $res as json");
          }
          return $r;
        case 'xml':
          $r = simplexml_load_string($res);
          if ($r === null) {
            throw new Exception("failed to decode $res as xml");
          }
          return $r;
      }
      return $res;
    }

 
}
