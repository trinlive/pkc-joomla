<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
?>
<div class="search">
    <a class="uk-navbar-toggle" href="#mod-search-searchword-modal" data-uk-search-icon data-uk-toggle></a>
</div>
<?php
ob_start();
?>
    <!-- Modal -->
    <div id="mod-search-searchword-modal" class="uk-modal-full uk-modal" data-uk-modal>
        <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport>
            <button class="uk-modal-close-full" type="button" data-uk-close></button>
            <form action="<?php echo Route::_('index.php'); ?>" method="post" class="uk-search uk-search-large">
                <input name="searchword" id="mod-search-searchword<?php echo $module->id; ?>" class="uk-search-input uk-text-center" type="search" placeholder="<?php echo $text; ?>" autofocus>
                <input type="hidden" name="task" value="search" />
                <input type="hidden" name="option" value="com_search" />
                <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
            </form>
        </div>
    </div>
<?php
$jollyany_mod_search_modal = ob_get_clean();
$document = Astroid\Framework::getDocument();
$document->addCustomTag($jollyany_mod_search_modal, 'body');