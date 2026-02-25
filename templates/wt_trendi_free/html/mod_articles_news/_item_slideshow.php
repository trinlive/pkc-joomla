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

<li class="el-item" tabindex="-1">
        <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>               
        <img class="el-image uk-cover" src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>" data-uk-cover>
        <?php endif; ?>

<div class="uk-position-small uk-position-center-left">
    <div class="el-overlay uk-overlay uk-overlay-default uk-padding uk-width-xlarge uk-margin-remove-first-child">
        

<?php if ($params->get('item_title')) : ?>
<?php $item_heading = $params->get('item_heading', 'h1'); ?>
<<?php echo $item_heading; ?> class="el-title uk-h3 uk-margin-small-top uk-margin-remove-bottom">
<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
    <a class="uk-link-text" href="<?php echo $item->link; ?>">
        <?php echo $item->title; ?>
    </a>
<?php else : ?>
    <?php echo $item->title; ?>
<?php endif; ?>
</<?php echo $item_heading; ?>>
<?php endif; ?>


<?php if (!$params->get('intro_only')) : ?>
<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php if ($params->get('show_introtext', 1)) : ?>
<div class="el-content uk-margin-small-top"><?php echo $item->introtext; ?></div>
<?php endif; ?>

<?php echo $item->afterDisplayContent; ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<div class="uk-margin-small-top"><a class="el-link uk-button uk-button-primary" href="' . $item->link . '">' . $item->linkText . '</a></div>'; ?>
<?php endif; ?>

    </div>
</div>
</li>

