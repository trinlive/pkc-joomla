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

use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

?>

<div class="row">
    <div class="col-md-12">
        <nav aria-label="Toolbar">
            <div class="btn-toolbar d-flex" role="toolbar" id="toolbar">
                <joomla-toolbar-button list-selection="">
                    <button onclick="if (document.adminForm.boxchecked.value === 0) {
                    alert('Please first make a selection from the list');
                } else {
                    if (window.parent) {
                        window.parent.jSelectItem('<?php echo $this->cid; ?>', '<?php echo $this->extension_name; ?>', '<?php echo $this->name; ?>', findChecked());
                        window.parent.jCloseModal(<?php echo $this->cid; ?>);
                    }
                }" class="btn btn-info">
                        <span class="fas fa-check" aria-hidden="true"></span><?php echo Text::_('COM_SPTRANSFER_CHOOSE'); ?>
                    </button>
                </joomla-toolbar-button>
            </div>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo Route::_('index.php?option=com_sptransfer&amp;view=selects&amp;layout=default&amp;tmpl=component&amp;extension_name=' . $this->extension_name . '&amp;name=' . $this->name . '&amp;cid=' . $this->cid); ?>" method="post" name="adminForm" id="adminForm">
            <div class="row">
                <div class="col-md-12">
                    <div id="j-main-container" class="j-main-container">
                        <?php
                        echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this));
                        ?>
                        <?php if (empty($this->items)) : ?>
                            <div class="alert alert-warning alert-no-items">
                                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                            </div>
                        <?php else : ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%">
                                        </th>
                                        <th width="1%">
                                            <input type="checkbox" name="checkall-toggle" value="" title="<?php echo Text::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                                        </th>
                                        <?php foreach ($this->items[0] as $i => $item) : ?>
                                            <?php if ($i != 'sp_id') echo '<th>' . $i . '</th>'; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($this->items as $i => $item) : ?>
                                        <tr class="row<?php echo $i % 2; ?>">
                                            <td class="width-1">
                                                <?php echo $item->sp_id; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo JHtml::_('grid.id', $item->sp_id, $item->sp_id); ?>
                                            </td>
                                            <?php foreach ($item as $j => $value) : ?>
                                                <?php if ($j != 'sp_id') echo '<td>' . $value . '</td>'; ?>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="<?php echo count(ArrayHelper::fromObject($this->items[0])); ?>">
                                            <div class="btn-group pull-left">
                                                <label for="limit" class="element-invisible"><?php echo Text::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                                                <?php echo $this->pagination->getListFooter(); ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="task" value="" />
                    <input type="hidden" name="boxchecked" value="0" />
                    <?php echo JHtml::_('form.token'); ?>
                </div>
            </div>
        </form>
    </div>
</div>