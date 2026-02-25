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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

?>
<tr>
    <th width="1%" class="hidden">
        <?php echo Text::_('JGLOBAL_FIELD_ID_LABEL'); ?>
    </th>
    <th width="20">
        <?php echo HTMLHelper::_('grid.checkall'); ?>
    </th>
    <th class="left">
        <?php echo Text::_('COM_SPTRANSFER_FIELD_EXTENSION_EXTENSION_LABEL'); ?>
    </th>
    <th class="left">
        <?php echo Text::_('COM_SPTRANSFER_FIELD_EXTENSION_DESCRIPTION_LABEL'); ?>
    </th>
    <th class="center">
        <?php echo Text::_('COM_SPTRANSFER_FIELD_IDS_DESCRIPTION_LABEL'); ?>
    </th>
    <th width="10%">

    </th>
</tr>