<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

?>
<div class="tm-headline-module uk-child-width-expand uk-grid-collapse uk-flex uk-flex-middle uk-card uk-card-primary uk-card-small uk-light<?php if ($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" data-uk-grid>
    <div class="uk-width-auto@m uk-first-column">
        <div class="uk-card tm-heading">
            <div class="tm-title"><?php echo JText::_('HU_TRENDI_BREAKING_NEWS'); ?></div>
        </div>
    </div>
    <div data-uk-slider="sets: true;autoplay: true;" class="uk-slider">
        <div class="uk-position-relative">
            <ul class="uk-slider-items uk-grid" style="transform: translate3d(-1103.67px, 0px, 0px);">
                <?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
                    <?php $item = $list[$i]; ?>
                        <?php require ModuleHelper::getLayoutPath('mod_articles_news', '_item_headline'); ?>
                <?php endfor; ?>
            </ul>
            <div class="uk-slidenav-container uk-position-small uk-position-center-right uk-visible@s">
                <a class="tm-slidenav" data-uk-slidenav-previous href="#" data-uk-slider-item="previous"></a>
                <a class="tm-slidenav" data-uk-slidenav-next href="#" data-uk-slider-item="next"></a>
            </div>
        </div>	
    </div>
</div>
