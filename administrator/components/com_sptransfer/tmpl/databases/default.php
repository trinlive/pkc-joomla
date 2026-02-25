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
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.multiselect');

$app = Factory::getApplication();
$user = Factory::getUser();
$userId = $user->get('id');
$columns = 10;
?>

<script type="text/javascript">
    KAINOTOMO_submitbutton = function (task) {

        if (confirm("Are you sure you want to proceed?")) {
            // do nothing
        } else {
            return;
        }
        
        form = document.getElementById('adminForm');
        if (task === 'databases.transfer') {
            SPCYEND_core.transfer(task, form);
            return;
        }
    }
</script>

<form action="<?php echo Route::_('index.php?option=com_sptransfer&view=databases'); ?>" method="post" name="adminForm" id="adminForm">        
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <div class="alert alert-info" hidden="true" id="cyend_log"></div>
                <div class="alert" hidden="true" id="get_last_id"></div>        
                <table class="table table-striped" id="sptransfer_table">                   
                    <?php echo $this->loadTemplate('head'); ?>
                    <?php echo $this->loadTemplate('body'); ?>
                    <?php echo $this->loadTemplate('foot'); ?>
                </table>

                <input type="hidden" name="task" value="" id="current_task">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>

            </div>
        </div>
    </div>
</form>
