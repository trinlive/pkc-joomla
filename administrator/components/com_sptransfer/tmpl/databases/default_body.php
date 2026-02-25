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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

?>

<tbody>
    <?php foreach ($this->items as $i => $item): ?>
            <tr class="row<?php echo $i % 2; ?>">
                <td>
                    <?php echo $item->id; ?>
                </td>
                <td>
                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                </td>	
                <td class="left">
                    <input type="hidden" name="input_prefixes[]" id="input_prefixes" value="<?php echo Text::_($item->prefix); ?>"  >
                    <input type="hidden" name="input_names[]" id="input_names" value="<?php echo $item->name; ?>" >
                    <div name="names[]" class="hidden" id="names<?php echo $i; ?>" ><?php echo $item->prefix . '_' . $item->name; ?></div>
                    <input type="hidden" name="status[]" id="status<?php echo $i; ?>" value="" >
                    <?php echo Text::_($item->prefix . '_' . $item->name); ?>
                </td>
                <td class="center">
                    <input type="text" name="input_ids[]" id="input_ids<?php echo $i;?>" value="" class="inputbox" size="45" aria-invalid="false" >
                </td>
                <td class="right">
                            <div class="btn-group">   
                                <a class="btn btn-mini btn-primary"
                                   role="button"
                                   data-bs-target="#ModalSelect_<?php echo $i; ?>"
                                   data-bs-toggle="modal"
                                   title="<?php echo Text::_('COM_SPTRANSFER_CHOOSE'); ?>" 
                                   href="#" >
                                       <?php echo Text::_('COM_SPTRANSFER_CHOOSE'); ?>
                                </a>

                                <?php
                                echo HTMLHelper::_(
                                        'bootstrap.renderModal', 'ModalSelect_' . $i, array(
                                    'title' => Text::_('COM_SPTRANSFER_CHOOSE'),
                                    'url' => Route::_('index.php?option=com_sptransfer&amp;view=selects&amp;layout=default&amp;tmpl=component&amp;extension_name=' . $item->TABLE_NAME . '&amp;name=' . $item->name . '&amp;cid=' . $i),
                                    'height' => '400px',
                                    'width' => '900px',
                                    'bodyHeight' => 70,
                                    'modalWidth' => 80,
                                    'footer' => '<a role="button" id="close-modal' . $i . '" class="btn btn-secondary" data-bs-dismiss="modal" aria-hidden="true">'
                                    . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>',
                                ));
                                ?>

                                <a class="btn btn-secondary" title="<?php echo Text::_('JCLEAR'); ?>" href="#" onclick="jClearItem('<?php echo $i; ?>');"><?php echo Text::_('JCLEAR'); ?></a>

                            </div>
                </td>
            </tr>
    <?php endforeach; ?>
</tbody>