<?php
/**
 * @package   Nicepage Website Builder
 * @author    Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

namespace NP\Utility;

use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

/**
 * Categories  filter processor
 */
class CategoriesFilter
{
    private $_categories;
    private $_pageId;
    private $_currentCatId;
    private $_isVm;

    /**
     * @param array  $categories   List of categories
     * @param int    $pageId       Page id
     * @param int    $currentCatId Current category id
     * @param string $productName  Site products template name
     */
    public function __construct($categories, $pageId, $currentCatId, $productName = '')
    {
        $this->_categories = $categories;
        $this->_pageId = $pageId;
        $this->_currentCatId = $currentCatId;
        $this->_isVm = !$productName ? true : false;
    }

    /**
     * Process categories filter
     *
     * @param string $html Page html
     *
     * @return array|string|string[]|null
     */
    public function process($html)
    {
        $re = '/<\!--products_categories_filter_select-->([\s\S]+?)<\!--\/products_categories_filter_select-->/';
        return preg_replace_callback($re, array(&$this, '_processCategoriesFilterSelect'), $html);
    }

    /**
     * Process filter select
     *
     * @param array $selectMatch Matches
     *
     * @return array|string|string[]
     */
    private function _processCategoriesFilterSelect($selectMatch) {
        $selectHtml = $selectMatch[1];
        $selectHtml = preg_replace('/<option[\s\S]+?<\/option>/', '', $selectHtml);
        $optionTemplate = '<option value="[[value]]">[[content]]</option>';
        $options = $this->_getCategoriesFilterOptions($this->_categories, $optionTemplate);
        $selectHtml = str_replace('</select>', $options . '</select>', $selectHtml);
        $script = '';
        if ($this->_isVm) {
            $selectHtml = str_replace('u-select-categories', 'u-select-categories u-select-categories-cms', $selectHtml);
            ob_start();
            ?>
            <script>
                jQuery(function ($) {
                    $('.u-select-categories.u-select-categories-cms').on('change', function (event) {
                        var href = this.value;
                        $.post(href).done(function (html) {
                            $(event.currentTarget).closest('.u-products').replaceWith(html);
                        });
                    })
                });
            </script>
            <?php
            $script = ob_get_clean();
        }
        return $selectHtml . $script;
    }

    /**
     * Build options for select
     *
     * @param array  $categories     Product categories
     * @param string $optionTemplate Option template
     * @param int    $level          Level of tree
     *
     * @return string
     */
    private function _getCategoriesFilterOptions($categories, $optionTemplate, $level = 0)
    {
        $result = '';
        foreach ($categories as $category) {
            $value = $category->id;
            if ($this->_isVm) {
                $value = Uri::root(true) . '/index.php?option=com_nicepage&task=productlist&pageId=' . $this->_pageId . '&virtuemart_category_id=' . $value;
            }
            $title = str_repeat('--', $level) . ' ' . $category->title;
            $option = str_replace('[[value]]', $value, $optionTemplate);
            $option = str_replace('[[content]]', $title, $option);
            if ($this->_currentCatId && $this->_currentCatId == $category->id) {
                $option = str_replace('<option', '<option selected', $option);
            }
            $result .= $option . "\n";
            if (count($category->children) > 0) {
                $result .= $this->_getCategoriesFilterOptions($category->children, $optionTemplate, $level + 1);
            }
        }
        return $result;
    }
}
