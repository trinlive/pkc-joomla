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

use Joomla\Component\Sptransfer\Administrator\Helper\SptransferHelper;
use Joomla\CMS\HTML\HTMLHelper;

?>
<?php foreach ($this->items_remote as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
            <td>
                <?php if ($item->name != '..') : ?>
                        <?php echo HTMLHelper::_('grid.id', $i, $item->type . '#' . $item->name); ?>
                <?php endif; ?>
            </td>
            <td>                     
                <?php if (isset($item->icon_16)) : ?>
                        <?php if ($item->type == 'directory') : ?>
                                <a href="#" onclick="browse_remote('<?php echo $item->path; ?>');" >
                                    <?php echo HTMLHelper::_('image', $item->icon_16, $item->name, null, true, true) ? HTMLHelper::_('image', $item->icon_16, $item->name, array('width' => 16, 'height' => 16), true) : HTMLHelper::_('image', 'com_sptransfer/con_info.png', $item->name, array('width' => 16, 'height' => 16), true); ?> 
                                </a>
                        <?php else : ?>
                                <?php echo HTMLHelper::_('image', $item->icon_16, $item->name, null, true, true) ? HTMLHelper::_('image', $item->icon_16, $item->name, array('width' => 16, 'height' => 16), true) : HTMLHelper::_('image', 'com_sptransfer/con_info.png', $item->name, array('width' => 16, 'height' => 16), true); ?> 
                        <?php endif; ?>
                <?php endif; ?>
            </td>	
            <td class="left">
                <?php if ($item->type == 'directory') : ?>
                        <a href="#" onclick="browse_remote('<?php echo $item->path; ?>');" >
                            <?php echo $item->name; ?>
                        </a>
                <?php else : ?>
                        <?php echo JText::_($item->name); ?>
                <?php endif; ?>
            </td>
            <td class="center">            
                <?php if ($item->type == 'file') : ?>
                        <?php echo SptransferHelper::parseSize($item->size); ?>
                <?php endif; ?>
            </td>
        </tr>
<?php endforeach; ?>

