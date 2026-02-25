<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Router\Route;

if (ASTROID_JOOMLA_VERSION > 3) {
	\JLoader::registerAlias('ContentHelperRoute', 'Joomla\Component\Content\Site\Helper\RouteHelper');
} else {
	include_once(JPATH_COMPONENT . '/helpers/route.php');
}
$params         = $displayData->params;
$item_type      =   $params->get('jollyany_item_type', '');
$image_position =   'top';
if ($item_type) {
    $image_position         =   $params->get('image_'.$item_type.'_position','top');
}
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php $imgfloat = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro; ?>
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>"><img <?php if ($images->image_intro_caption) : ?> <?php echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"'; ?> <?php endif; ?> src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl"<?php if ($image_position == 'left' || $image_position == 'right') echo ' data-uk-cover'; ?> /></a>
	<?php else : ?><img <?php if ($images->image_intro_caption) : ?> <?php echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption, ENT_COMPAT, 'UTF-8') . '"'; ?> <?php endif; ?> src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl"<?php if ($image_position == 'left' || $image_position == 'right') echo ' data-uk-cover'; ?> />
	<?php endif; ?>
<?php endif; ?>