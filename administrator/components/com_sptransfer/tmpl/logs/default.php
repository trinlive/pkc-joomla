<?php
/**
 * @version		$Id: default.php 21837 2011-07-12 18:12:35Z dextercowley $
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

//HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');
HTMLHelper::_('behavior.multiselect');

$user = Factory::getUser();
$userId = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo Route::_('index.php?option=com_sptransfer&view=logs'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <?php if (empty($this->items)) : ?>
                        <div class="alert alert-warning">
                            <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                        </div>
                <?php else : ?>           
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="20">
                                        <?php echo HTMLHelper::_('grid.checkall'); ?>
                                    </th>
                                    <th class="title" width="10%">
                                        <?php echo HTMLHelper::_('searchtools.sort',  'COM_SPTRANSFER_FIELD_EXTENSION_EXTENSION_LABEL', 'a.tables_id', $listDirn, $listOrder); ?>
                                    </th>
                                    <th class="title" width="20%">
                                        <?php echo HTMLHelper::_('searchtools.sort',  'COM_SPTRANSFER_FIELD_EXTENSION_STATE_LABEL', 'a.state', $listDirn, $listOrder); ?>
                                    </th>
                                    <th width="40%" class="nowrap">
                                        <?php echo Text::_('COM_SPTRANSFER_FIELD_EXTENSION_NOTE_LABEL'); ?>
                                    </th>
                                    <th width="10%" class="nowrap">
                                        <?php echo HTMLHelper::_('searchtools.sort',  'COM_SPTRANSFER_FIELD_EXTENSION_SOURCE_ID_LABEL', 'a.source_id', $listDirn, $listOrder); ?>
                                    </th>
                                    <th width="10%" class="nowrap">
                                        <?php echo Text::_('COM_SPTRANSFER_FIELD_EXTENSION_DESTINATION_ID_LABEL'); ?>
                                    </th>
                                    <th width="10%" class="nowrap">
                                        <?php echo HTMLHelper::_('searchtools.sort',  'JDATE', 'a.created', $listDirn, $listOrder); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <?php echo $this->pagination->getListFooter(); ?>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($this->items as $i => $item) : ?>
                                        <tr class="row<?php echo $i % 2; ?>">
                                            <td>
                                                <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>            
                                            </td>
                                            <td class="left">
                                                <?php echo $item->extension_name . '_' . $item->name; ?>
                                            </td>
                                            <td class="left">
                                                <?php echo Text::_('COM_SPTRANSFER_STATE_' . $item->state); ?>
                                            </td>
                                            <td class="left">
                                                <?php echo $item->note; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $item->source_id; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $item->destination_id; ?>
                                            </td>
                                            <td class="center">
                                                <?php //echo HTMLHelper::_('date', $item->created, Text::_('DATE_FORMAT_LC4') . ' H:i'); ?>
                                                <?php echo $item->created;?>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                <?php endif; ?>
                <div>
                    <input type="hidden" name="task" value="">
                    <input type="hidden" name="boxchecked" value="0">
                    <?php echo HTMLHelper::_('form.token'); ?>
                </div>
            </div>
        </div>
    </div>    


</form>
