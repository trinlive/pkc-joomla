<?php
/**
 * @package		SP Transfer
 * @subpackage	Components
 * @copyright	KAINOTOMO PH LTD - All rights reserved.
 * @author		KAINOTOMO PH LTD
 * @link		https://www.kainotomo.com
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

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
        if (task === 'tables.transfer') {
            SPCYEND_core.transfer(task, form);
            return;
        }
        if (task === 'tables.fix') {
            SPCYEND_core.transfer(task, form);
            return;
        }
        if (task === 'tables.transfer_all') {
            SPCYEND_core.transfer_all(task, form);
            return;
        }
    }
</script>
<form action="<?php echo Route::_('index.php?option=com_sptransfer&view=tables'); ?>" method="post" name="adminForm" id="adminForm">    
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <div class="alert alert-info" hidden="true" id="cyend_log"></div>
                <div class="alert" hidden="true" id="get_last_id"></div>
                <table class="table table-striped" id="sptransfer_table">
                    <thead><?php echo $this->loadTemplate('head'); ?></thead>                
                    <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
                    <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
                </table>
                <div>
                    <input type="hidden" name="task" value="" id="current_task" />
                    <input type="hidden" name="boxchecked" value="0" />
                    <?php echo HTMLHelper::_('form.token'); ?>
                </div>
            </div>
        </div>
    </div>       
</form>