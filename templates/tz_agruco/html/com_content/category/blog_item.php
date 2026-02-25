<?php

/**
 * @package   Jollyany Framework
 * @author    TemPlaza https://www.templaza.com
 * @copyright Copyright (C) 2011 - 2021 TemPlaza.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

jimport('jollyany.framework.article');

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;

if (ASTROID_JOOMLA_VERSION > 3) {
    \JLoader::registerAlias('ContentHelperRoute', 'Joomla\Component\Content\Site\Helper\RouteHelper');
} else {
    include_once(JPATH_COMPONENT . '/helpers/route.php');
}

// Astroid Article/Blog
$astroidArticle = new JollyanyFrameworkArticle($this->item, true);

$template = Astroid\Framework::getTemplate();
$document = Astroid\Framework::getDocument();

$is_lead    =   isset($this->item->is_leaditem) ? $this->item->is_leaditem : false;
$is_intro   =   isset($this->item->is_introitem) ? $this->item->is_introitem : false;


// Create shortcuts to some parameters.
$params = $this->item->params;
$canEdit = $params->get('access-edit');
$info = $params->get('info_block_position', 0);
$images = json_decode($this->item->images);

$tpl_params = $template->getParams();
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ||  $tpl_params->get('astroid_readtime', 1));

// Post Format
$post_attribs = new Registry(json_decode($this->item->attribs));
$post_format = $post_attribs->get('post_format', 'standard');

// Image position
$image_width = $image_width_xl = $image_width_l = $image_width_m = $image_width_s = $expand_width = '';
if ($is_lead) {
    $image_position         =   $params->get('image_lead_position','top');
    if ($image_position == 'left' || $image_position == 'right') {
        $image_width            =   ' uk-width-'. $params->get('image_lead_width','1-1');
        $image_width_xl         =   ' uk-width-'. $params->get('image_lead_width_xl','1-3').'@xl';
        $image_width_l          =   ' uk-width-'. $params->get('image_lead_width_l','1-3').'@l';
        $image_width_m          =   ' uk-width-'. $params->get('image_lead_width_m','1-2').'@m';
        $image_width_s          =   ' uk-width-'. $params->get('image_lead_width_s','1-1').'@s';
        $expand_width           =   $image_width_xl == ' uk-width-1-1@xl' ? ' uk-width-1-1@xl' : ' uk-width-expand@xl';
        $expand_width           .=  $image_width_l == ' uk-width-1-1@l' ? ' uk-width-1-1@l' : ' uk-width-expand@l';
        $expand_width           .=  $image_width_m == ' uk-width-1-1@m' ? ' uk-width-1-1@m' : ' uk-width-expand@m';
        $expand_width           .=  $image_width_s == ' uk-width-1-1@s' ? ' uk-width-1-1@s' : ' uk-width-expand@s';
        $expand_width           .=  $image_width == ' uk-width-1-1' ? ' uk-width-1-1' : ' uk-width-expand';
    }
    $params->set('jollyany_item_type', 'lead');
} elseif ($is_intro) {
    $image_position         =   $params->get('image_intro_position','top');
    if ($image_position == 'left' || $image_position == 'right') {
        $image_width            =   ' uk-width-'. $params->get('image_intro_width','1-1');
        $image_width_xl         =   ' uk-width-'. $params->get('image_intro_width_xl','1-3').'@xl';
        $image_width_l          =   ' uk-width-'. $params->get('image_intro_width_l','1-3').'@l';
        $image_width_m          =   ' uk-width-'. $params->get('image_intro_width_m','1-2').'@m';
        $image_width_s          =   ' uk-width-'. $params->get('image_intro_width_s','1-1').'@s';
        $expand_width           =   $image_width_xl == ' uk-width-1-1@xl' ? ' uk-width-1-1@xl' : ' uk-width-expand@xl';
        $expand_width           .=  $image_width_l == ' uk-width-1-1@l' ? ' uk-width-1-1@l' : ' uk-width-expand@l';
        $expand_width           .=  $image_width_m == ' uk-width-1-1@m' ? ' uk-width-1-1@m' : ' uk-width-expand@m';
        $expand_width           .=  $image_width_s == ' uk-width-1-1@s' ? ' uk-width-1-1@s' : ' uk-width-expand@s';
        $expand_width           .=  $image_width == ' uk-width-1-1' ? ' uk-width-1-1' : ' uk-width-expand';
    }
    $params->set('jollyany_item_type', 'intro');
} else {
    $image_position         =   'top';
}

if (empty($image_position)) {
    $image_position    =   'top';
}

$info_block_layout = ASTROID_JOOMLA_VERSION > 3 ? 'joomla.content.info_block' : 'joomla.content.info_block.block';

if (ASTROID_JOOMLA_VERSION > 3) {
    $currentDate   = Factory::getDate()->format('Y-m-d H:i:s');
    $isUnpublished = ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED || $this->item->publish_up > $currentDate)
        || ($this->item->publish_down < $currentDate && $this->item->publish_down !== null);
} else {
    $isUnpublished = $this->item->state == 0 || ($this->item->publish_up ? strtotime($this->item->publish_up) : 0) > strtotime(Factory::getDate()) || ((($this->item->publish_down ? strtotime($this->item->publish_down) : 0 ) < strtotime(Factory::getDate())) && $this->item->publish_down != Factory::getDbo()->getNullDate());
}
?>
<?php if ($isUnpublished) : ?>
    <div class="system-unpublished">
<?php endif; ?>
<?php
$image = $astroidArticle->getImage();
if (((!empty($images->image_intro)) && $post_format == 'standard') || (is_string($image) && !empty($image))) {
    if ($image_position == 'left' || $image_position == 'right' || $image_position == 'bottom') {
        echo '<div class="uk-card" data-uk-grid>';
        if ($image_position == 'left' || $image_position == 'right') {
            echo '<div class="uk-position-relative uk-card-media-'.$image_position.($image_position == 'right' ? ' uk-flex-last@l' : '').$image_width_xl.$image_width_l.$image_width_m.$image_width_s.$image_width.'">';
            echo '<div class="uk-cover-container uk-height-1-1 uk-border-rounded">';
        } else {
            echo '<div class="uk-card-media-'.$image_position.' uk-margin-remove-top uk-flex-last"><div class="uk-height-1-1">';
        }

    }
}
if ((!empty($images->image_intro)) && $post_format == 'standard') {
    echo LayoutHelper::render('joomla.content.intro_image', $this->item);
} else if (is_string($image) && !empty($image)) {
    $document->include('blog.modules.image', ['image' => $image, 'title' => $this->item->title, 'item' => $this->item]);
} else {
    echo LayoutHelper::render('joomla.content.post_formats.post_' . $post_format, array('params' => $post_attribs, 'item' => $this->item));
}
if (((!empty($images->image_intro)) && $post_format == 'standard') || (is_string($image) && !empty($image))) {
    if ($image_position == 'left' || $image_position == 'right' || $image_position == 'bottom') {
        echo ($image_position == 'left' || $image_position == 'right') ? '<canvas width="600" height="400"></canvas>' : '';
        echo '</div>';
        $astroidArticle->renderArticleBadge();
        echo '</div>';
    }
}
if ($image_position == 'left' || $image_position == 'right') echo '<div class="uk-margin-remove-top'.$expand_width.'">';
?>
    <div>
        <?php if ($image_position != 'left' && $image_position != 'right') $astroidArticle->renderArticleBadge(); ?>
        <div class="uk-card-body uk-padding-remove-left uk-padding-remove-right<?php echo $tpl_params->get('show_post_format') ? ' has-post-format' : ''; ?><?php echo (!empty($image) ? ' has-image' : ''); ?>">

            <?php echo LayoutHelper::render('joomla.content.post_formats.icons', $post_format); ?>

            <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
                <?php echo LayoutHelper::render($info_block_layout, array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'above')); ?>
            <?php endif; ?>

            <div class="article-title item-title">
                <?php echo LayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
            </div>

            <div class="article-intro-text">
                <?php echo $this->item->introtext; ?>
            </div>

            <?php if ($info == 1 || $info == 2) : ?>
                <?php if ($useDefList) : ?>
                    <?php echo LayoutHelper::render($info_block_layout, array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'below')); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!$params->get('show_intro')) : ?>
                <?php echo $this->item->event->afterDisplayTitle; ?>
            <?php endif; ?>

            <?php echo $this->item->event->beforeDisplayContent; ?>

            <?php
            if ($params->get('show_readmore') && $this->item->readmore) :
                if ($params->get('access-view')) :
                    $link = Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
                else :
                    $menu = Factory::getApplication()->getMenu();
                    $active = $menu->getActive();
                    $itemId = $active->id;
                    $link1 = Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
                    $returnURL = Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
                    $link = new Uri($link1);
                    $link->setVar('return', base64_encode($returnURL));
                endif;
                ?>
                <?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
            <?php endif; ?>
        </div>
    </div>
<?php if ($image_position == 'left' || $image_position == 'right') echo '</div></div>'; ?>
<?php if ($isUnpublished) : ?>
    </div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>