<?php
/**
 * @package		SP Transfer
 * @subpackage	Components
 * @copyright	KAINOTOMO PH LTD - All rights reserved.
 * @author		KAINOTOMO PH LTD
 * @link		https://www.kainotomo.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('behavior.multiselect');
?>
<script type="text/javascript">
    KAINOTOMO_submitbutton = function (task) {
        
        if (confirm("Are you sure you want to proceed?")) {
            // do nothing
        } else {
            return;
        }

        form = document.getElementById('adminForm');
        if (task === 'files.transfer') {
            SPCYEND_core.transfer(task, form);
            return;
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_sptransfer&view=files'); ?>" method="post" name="adminForm" id="adminForm">

    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <div class="alert alert-info" hidden="true" id="cyend_log"></div>
                <div class="alert" hidden="true" id="get_last_id"></div>
                <div id="sptransfer_table" class="row">
                    <div class="col-md-6">        
                        <legend><?php echo JText::_('COM_SPTRANSFER_REMOTE_SITE'); ?></legend>
                        <?php if (is_array($this->items_remote)) : ?>
                            <table class="table table-condensed table-bordered table-striped" >
                                <thead><?php echo $this->loadTemplate('head_remote'); ?></thead>
                                <tfoot><?php echo $this->loadTemplate('foot_remote'); ?></tfoot>
                                <tbody><?php echo $this->loadTemplate('remote'); ?></tbody>                                                                    
                            </table>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <legend><?php echo JText::_('COM_SPTRANSFER_LOCAL_SITE'); ?></legend>
                        <table class="table table-condensed table-bordered table-striped">
                            <thead><?php echo $this->loadTemplate('head_local'); ?></thead>
                            <tfoot><?php echo $this->loadTemplate('foot_local'); ?></tfoot>
                            <tbody><?php echo $this->loadTemplate('local'); ?></tbody>                            
                        </table>
                    </div>
                </div>
                <div>
                    <input type="hidden" id="folder_remote" name="folder_remote" value="<?php echo $this->folder_remote; ?>" />
                    <input type="hidden" id="folder_local" name="folder_local" value="<?php echo $this->folder_local; ?>" />
                    <input type="hidden" name="task" value="" />
                    <input type="hidden" name="boxchecked" value="0" />
                    <?php echo HTMLHelper::_('form.token'); ?>
                </div>
            </div>
        </div>
    </div>    
</form>