<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<li class="tm-item uk-width-1-1 uk-width-1-1@m" tabindex="-1">
<?php if ($params->get('item_title')) : ?>
<?php $item_heading = $params->get('item_heading', 'h1'); ?>
<<?php echo $item_heading; ?> class="el-title">
<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
    <a class="uk-link-text" href="<?php echo $item->link; ?>">
        <?php echo $item->title; ?>
    </a>
<?php else : ?>
    <?php echo $item->title; ?>
<?php endif; ?>
</<?php echo $item_heading; ?>>
<?php endif; ?>
</li>

