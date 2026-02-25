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


<div class="el-item">

<div class="uk-child-width-expand uk-grid-small" data-uk-grid>
  <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
	<div class="uk-width-1-3">
  		<img src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>" class="uk-border-rounded">
  		<?php if (!empty($item->imageCaption)) : ?>
  			<figcaption>
  				<?php echo $item->imageCaption; ?>
  			</figcaption>
  		<?php endif; ?>
	  </div>
  <?php endif; ?>
<div class="uk-margin-remove-first-child">

  <?php if ($params->get('item_title')) : ?>
  	<?php $item_heading = $params->get('item_heading', 'h4'); ?>
  	<<?php echo $item_heading; ?> class="el-title uk-h4 uk-margin-remove-bottom newsflash-title">
  	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
  		<a class="uk-link" href="<?php echo $item->link; ?>">
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


  <?php echo $item->afterDisplayContent; ?>

<div class="el-date uk-text-meta uk-margin-small-top">
<?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
</div>
</div>
</div>
</div>	


