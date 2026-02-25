<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Module\Finder\Site\Helper\FinderHelper;

// Load the smart search component language file.
$lang = $app->getLanguage();
$lang->load('com_finder', JPATH_SITE);

$input = '<input type="search" name="q" id="mod-finder-searchword' . $module->id . '" class="js-finder-search-query form-control uk-search-input uk-text-center" value="' . htmlspecialchars($app->input->get('q', '', 'string'), ENT_COMPAT, 'UTF-8') . '"'
	. ' placeholder="' . Text::_('MOD_FINDER_SEARCH_VALUE') . '">';

$showLabel  = $params->get('show_label', 1);
$labelClass = (!$showLabel ? 'visually-hidden ' : '') . 'finder';
$label      = '<label for="mod-finder-searchword' . $module->id . '" class="' . $labelClass . '">' . $params->get('alt_label', Text::_('JSEARCH_FILTER_SUBMIT')) . '</label>';

$output = '';

if ($params->get('show_button', 0))
{
	$output .= $label;
	$output .= '<div class="mod-finder__search input-group">';
	$output .= $input;
	$output .= '<button class="btn btn-primary" type="submit"><span class="icon-search icon-white" aria-hidden="true"></span> ' . Text::_('JSEARCH_FILTER_SUBMIT') . '</button>';
	$output .= '</div>';
}
else
{
	$output .= $label;
	$output .= $input;
}

Text::script('MOD_FINDER_SEARCH_VALUE', true);

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_finder');

/*
 * This segment of code sets up the autocompleter.
 */
if ($params->get('show_autosuggest', 1))
{
	$wa->usePreset('awesomplete');
	$app->getDocument()->addScriptOptions('finder-search', array('url' => Route::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component')));
}

$itemid     =   (int) $params->get('set_itemid', 0);

$wa->useScript('com_finder.finder');
if ($itemid) {
    $route  .=  '&Itemid='. $itemid;
}

?>
<div class="search">
    <a class="" href="#mod-search-searchword-modal<?php echo $module->id; ?>" data-uk-search-icon data-uk-toggle></a>
</div>
<?php
ob_start();
?>
    <!-- Modal -->
    <div id="mod-search-searchword-modal<?php echo $module->id; ?>" class="uk-modal-full uk-modal" data-uk-modal>
        <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport>
            <button class="uk-modal-close-full" type="button" data-uk-close></button>
            <form class="mod-finder js-finder-searchform form-search uk-search uk-search-large" action="<?php echo Route::_($route); ?>" method="post" role="search">
                <?php echo $output; ?>

                <?php $show_advanced = $params->get('show_advanced', 0); ?>
                <?php if ($show_advanced == 2) : ?>
                    <br>
                    <a href="<?php echo Route::_($route); ?>" class="mod-finder__advanced-link"><?php echo Text::_('COM_FINDER_ADVANCED_SEARCH'); ?></a>
                <?php elseif ($show_advanced == 1) : ?>
                    <div class="mod-finder__advanced js-finder-advanced">
                        <?php echo HTMLHelper::_('filter.select', $query, $params); ?>
                    </div>
                <?php endif; ?>
                <?php echo $itemid ? '<input type="hidden" name="Itemid" value="'.$itemid.'" />' : FinderHelper::getGetFields($route, (int) $params->get('set_itemid', 0)); ?>
            </form>
        </div>
    </div>
<?php
$jollyany_mod_search_modal = ob_get_clean();
$document = Astroid\Framework::getDocument();
$document->addCustomTag($jollyany_mod_search_modal, 'body');

