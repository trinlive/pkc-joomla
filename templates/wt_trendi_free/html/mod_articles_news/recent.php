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
<div class="tm-trendi-recent uk-margin uk-child-width-1-1 uk-child-width-1-2@s uk-grid-match<?php if ($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" data-uk-grid>
	<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
		<?php $item = $list[$i]; ?>
		<?php if ($i == 0) : ?>
			<div>
			<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
				<a class="uk-link-reset" href="<?php echo $item->link; ?>">
					<img src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>" class="uk-border-rounded uk-box-shadow-small">
				</a>
				<?php if (!empty($item->imageCaption)) : ?>
					<figcaption>
						<?php echo $item->imageCaption; ?>
					</figcaption>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('item_title')) : ?>
				<?php $item_heading = $params->get('item_heading', 'h4'); ?>
				<<?php echo $item_heading; ?> class="el-title uk-h4 uk-margin-remove-bottom uk-margin-small-top newsflash-title">
					<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
						<a class="tm-link" href="<?php echo $item->link; ?>">
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
				<div class="el-content uk-margin-small-top">
				<?php echo $item->introtext; ?>
				</div>
			<?php endif; ?>

			<?php echo $item->afterDisplayContent; ?>

			<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
				<?php echo '<div><a class="uk-button uk-button-primary" href="' . $item->link . '">' . $item->linkText . '</a></div>'; ?>
			<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php endfor; ?>
			
			<div class="uk-grid-small uk-grid-divider" data-uk-grid>
		
			<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
			<?php $item = $list[$i]; ?>
			<?php if ($i > 0) : ?>
		
			<?php require ModuleHelper::getLayoutPath('mod_articles_news', '_item_recent'); ?>
			<?php endif; ?>
			<?php endfor; ?>
  </div>
	
</div>
