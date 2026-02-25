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
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

?>
<?php foreach ($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
            <td class="hidden">
                <?php echo $item->id; ?>
            </td>
            <td>
                <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
            </td>	
            <td class="left" id="names<?php echo $i; ?>">
                <?php echo Text::_($item->extension_name); ?>
                <?php echo ' -> '; ?>
                <?php echo Text::_($item->extension_name . '_' . $item->name); ?>
            </td>
            <td class="left">
                <?php echo Text::_($item->extension_name . '_' . $item->name . '_desc'); ?>
            </td>
            <td class="center">            
                <input type="text" name="input_ids[]" id="input_ids<?php echo $i; ?>" value="" class="inputbox" size="45" aria-invalid="false">
                <input type="hidden" name="status[]" id="status<?php echo $i; ?>" value="" >
            </td>
            <td class="left">
                <?php if ($this->dbTestConnection) : ?>

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
                            'url' => Route::_('index.php?option=com_sptransfer&amp;view=selects&amp;layout=default&amp;tmpl=component&amp;extension_name=' . $item->extension_name . '&amp;name=' . $item->name . '&amp;cid=' . $i),
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
                <?php endif; ?>
            </td>
        </tr>
<?php endforeach; ?>
