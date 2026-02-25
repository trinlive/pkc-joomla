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
?>

<thead>
    <tr>
        <th width="1%">
            <?php echo Text::_('JGLOBAL_FIELD_ID_LABEL'); ?>
        </th>
        <th width="20">
            <?php echo HTMLHelper::_('grid.checkall'); ?>
        </th>
        <th class="left">
            <?php echo Text::_('COM_SPTRANSFER_FIELD_TABLE_NAME_LABEL'); ?>
        </th>
        <th class="center">
            <?php echo Text::_('COM_SPTRANSFER_FIELD_TABLE_IDS_LABEL'); ?>
        </th>
        <th width="10%">

        </th>
    </tr>
</thead>