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

?>
<tr>
    <th width="1%">
        <?php echo HTMLHelper::_('grid.checkall'); ?>
    </th>
    <th width="5%"></th>
    <th class="left">
        <?php echo JText::_('COM_SPTRANSFER_NAME'); ?>
    </th>
    <th class="center" width="20%">
        <?php echo JText::_('COM_SPTRANSFER_FILESIZE'); ?>
    </th>
</th>
</tr>

