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
<div data-uk-slideshow="min-height: 350; max-height: 450;autoplay: true;" class="tm-module-slideshow uk-slideshow<?php if ($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<div class="uk-position-relative">

		<ul class="uk-slideshow-items">	
			<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
				<?php $item = $list[$i]; ?>
					<?php require ModuleHelper::getLayoutPath('mod_articles_news', '_item_slideshow'); ?>
			<?php endfor; ?>
		</ul>

		<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-previous data-uk-slideshow-item="previous"></a>
		<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" data-uk-slidenav-next data-uk-slideshow-item="next"></a>

		<div class="uk-position-bottom-center uk-position-medium uk-light uk-visible@xl">
			<ul class="el-nav uk-dotnav uk-flex-center" uk-margin>
				<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
					<li data-uk-slideshow-item="<?php echo $i; ?>">
					<?php $item = $list[$i]; ?>
					<a href="#"><?php echo $item->title; ?></a>
					</li>	
				<?php endfor; ?>
			</ul>
		</div>
	</div>	
</div>