<?php
/**
 * @package   Nicepage Website Builder
 * @author    Nicepage https://www.nicepage.com
 * @copyright Copyright (c) 2016 - 2019 Nicepage
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

namespace NP\Processor;

defined('_JEXEC') or die;

use NP\Utility\GridHelper;
use NP\Utility\Pagination;
use NP\Utility\CategoriesFilter;
use NP\Models\ContentModelCustomProducts;
use NP\Models\ContentModelCustomSiteProducts;
use Joomla\CMS\Factory;
use \vmJsApi, \ShopFunctions, \CurrencyDisplay;
use Joomla\CMS\Uri\Uri;

class ProductsProcessor
{
    private $_product = array();
    private $_addZeroCents = false;
    private $_pageId;
    private $_productName = null;
    private $_productsList = array();
    private $_productsPosition = 0;
    private $_paginationProps = null;

    private $_quantityExists = false;

    private $_siteProductsProcessing = false;

    /**
     * ProductsProcessor constructor.
     *
     * @param string $pageId      Page id
     * @param int    $productName Product Name
     */
    public function __construct($pageId = '', $productName = null)
    {
        $this->_pageId = $pageId;
        $this->_productName = $productName;
    }

    /**
     * Process products
     *
     * @param string $content Content
     *
     * @return string|string[]|null
     */
    public function process($content) {
        $position = Factory::getApplication()->input->get('position', '');
        if ($position && $this->_productName === 'product-list') {
            header('Content-Type: text/html');
            exit($this->fixers($this->processProductsByAjaxLoad($content)));
        } else {
            $content = preg_replace_callback('/<\!--products-->([\s\S]+?)<\!--\/products-->/', array(&$this, '_processProducts'), $content);
            $content = preg_replace_callback('/<\!--product-->([\s\S]+?)<\!--\/product-->/', array(&$this, '_processProduct'), $content);
        }

        if (strpos($content, 'none-post-image') !== false) {
            $content = str_replace('u-products-item', 'u-products-item u-invisible', $content);
        }

        return $this->fixers($content);
    }

    /**
     * @param string $content Content
     *
     * @return array|string|string[]
     */
    public function fixers($content) {
        $content = $this->_fixVmScripts($content);
        $content = $this->_fixDollarSymbol($content);
        $content = $this->_fixPageId($content);
        return $content;
    }

    /**
     * Process one products
     *
     * @param string $content Page content
     *
     * @return int
     */
    public function processProductsByAjaxLoad($content) {
        preg_replace_callback('/<\!--products-->([\s\S]+?)<\!--\/products-->/', array(&$this, '_processProducts'), $content);
        $position = Factory::getApplication()->input->get('position', 1);
        $result = array_slice($this->_productsList, $position - 1, 1);
        return count($result) > 0 ? $result[0] : 0;
    }

    /**
     * @param string $content Content
     *
     * @return array|string|string[]
     */
    private function _fixDollarSymbol($content)
    {
        return str_replace('_dollar_symbol_', '$', $content);
    }

    /**
     * @param string $content Content
     *
     * @return array|string|string[]
     */
    private function _fixPageId($content) {
        return str_replace('[[pageId]]', $this->_pageId, $content);
    }

    /**
     * Fix virtuemart scripts
     *
     * @param string $content Content
     *
     * @return mixed
     */
    private function _fixVmScripts($content)
    {
        $document = Factory::getDocument();
        $scripts = $document->_scripts;
        $index = 0;
        foreach ($scripts as $filePath => $script) {
            $index++;
            if (preg_match('/com\_virtuemart.+vmprices\.js/', $filePath)) {
                $before = array_slice($scripts, 0, $index - 1);
                $after = array_slice($scripts, $index);
                $newFilePath = str_replace('com_virtuemart', 'com_nicepage', $filePath);
                $new = array($newFilePath => $script);
                $scripts = array_merge($before, $new, $after);
            }
        }
        $document->_scripts = $scripts;

        $content = str_replace('Virtuemart.product($("form.product"));', 'Virtuemart.product($(".product"));', $content);
        return $content;
    }

    /**
     * Process products
     *
     * @param array $productsMatch Matches
     *
     * @return string|string[]|null
     */
    private function _processProducts($productsMatch) {
        $this->_paginationProps = null;
        $this->_productsPosition += 1;
        $productsHtml = $productsMatch[1];

        if (strpos($productsHtml, 'data-products-datasource="site"') !== false && !$this->_productName) {
            $this->_siteProductsProcessing = true;
            $productsHtml = preg_replace_callback('/<\!--product_button-->([\s\S]+?)<\!--\/product_button-->/', array(&$this, '_setButtonData'), $productsHtml);
            $productsHtml = preg_replace_callback('/<\!--product_image-->([\s\S]+?)<\!--\/product_image-->/', array(&$this, '_setImageData'), $productsHtml);
            $productsHtml = preg_replace_callback('/<\!--product_category-->([\s\S]+?)<\!--\/product_category-->/', array(&$this, '_setProductCategory'), $productsHtml);
            $this->_siteProductsProcessing = false;
            array_push($this->_productsList, $productsHtml);
            return $productsHtml;
        }

        $productsOptions = array();
        if (preg_match('/<\!--products_options_json--><\!--([\s\S]+?)--><\!--\/products_options_json-->/', $productsHtml, $matches)) {
            $productsOptions = json_decode($matches[1], true);
            $productsHtml = str_replace($matches[0], '', $productsHtml);
        }
        $productsSourceType = isset($productsOptions['type']) ? $productsOptions['type'] : '';
        if ($productsSourceType === 'products-featured') {
            $productsSource = 'Featured products';
        } else if ($productsSourceType === 'products-recent') {
            $productsSource = 'Recent products';
        } else {
            $productsSource = isset($productsOptions['source']) && $productsOptions['source'] ? $productsOptions['source'] : '';
        }
        $productsCount = isset($productsOptions['count']) ? (int) $productsOptions['count'] : '';
        $categoryId = Factory::getApplication()->input->get('virtuemart_category_id', '');
        $products = $this->_getProducts(array('categoryName' => $productsSource, 'categoryId' => $categoryId));

        if (count($products) < 1) {
            return '';
        }

        if ($productsCount && count($products) > $productsCount) {
            $app = Factory::getApplication();
            $limitstart = $app->input->get('offset', 0);
            $pageId = $app->input->get('pageId', $this->_pageId);
            $positionOnPage = $app->input->get('position', $this->_productsPosition);
            $this->_paginationProps = array(
                'allPosts' => count($products),
                'offset' => (int) $limitstart,
                'postsPerPage' => $productsCount,
                'pageId' => (int) $pageId,
                'positionOnPage' => $positionOnPage,
                'task' => 'productlist',
            );
            $products = array_slice($products, $limitstart, $productsCount);
        }

        $productsHtml = $this->processProductItem($productsHtml, $products);
        $productsHtml = $this->processCategoriesFilter($productsHtml, $this->_pageId, $categoryId);
        $productsHtml = $this->processPagination($productsHtml);

        $productsGridProps = isset($productsOptions['gridProps']) ? $productsOptions['gridProps'] : array();
        $productsHtml .= GridHelper::buildGridAutoRowsStyles($productsGridProps, count($products));

        if (strpos($productsHtml, 'data-products-datasource="site"') === false && $this->_productName === 'product-list') {
            $productsHtml = preg_replace('/^<div/', '<div data-products-id="' . $this->_productsPosition . '" data-products-datasource="site"', trim($productsHtml));
        }

        array_push($this->_productsList, $productsHtml);
        return $productsHtml;
    }

    /**
     * Process pagination
     *
     * @param string $html Page html
     *
     * @return array|string|string[]|null
     */
    public function processPagination($html) {
        return preg_replace_callback('/<\!--products_pagination-->([\s\S]+?)<\!--\/products_pagination-->/', array(&$this, '_processProductsPagination'), $html);
    }

    /**
     * Process pagination
     *
     * @param array $paginationMatch Matches
     *
     * @return false|mixed|string
     */
    private function _processProductsPagination($paginationMatch) {
        if (!$this->_paginationProps) {
            return '';
        }
        $paginationHtml = $paginationMatch[1];
        $paginationStyleOptions = array();
        if (preg_match('/<\!--products_pagination_options_json--><\!--([\s\S]+?)--><\!--\/products_pagination_options_json-->/', $paginationHtml, $matches)) {
            $paginationStyleOptions = json_decode($matches[1], true);
        }
        $pagination = new Pagination($this->_paginationProps, $paginationStyleOptions, $this->_productName);
        return $pagination->getPagination();
    }

    /**
     * Process categories filter in product list
     *
     * @param string $html         Page html
     * @param int    $pageId       Page id
     * @param int    $currentCatId Current category id
     *
     * @return array|string|string[]|null
     */
    public function processCategoriesFilter($html, $pageId, $currentCatId) {
        $filter = new CategoriesFilter($this->_getCategories(), $pageId, $currentCatId, $this->_productName);
        return $filter->process($html);
    }

    /**
     * Process product
     *
     * @param array $productMatch Matches
     *
     * @return string|string[]|null
     */
    private function _processProduct($productMatch) {
        $productHtml = $productMatch[1];

        if (strpos($productHtml, 'data-products-datasource="site"') !== false && !$this->_productName) {
            $this->_siteProductsProcessing = true;
            $productHtml = preg_replace_callback('/<\!--product_category-->([\s\S]+?)<\!--\/product_category-->/', array(&$this, '_setProductCategory'), $productHtml);
            $this->_siteProductsProcessing = false;
            return $productHtml;
        }

        $productOptions = array();
        if (preg_match('/<\!--product_options_json--><\!--([\s\S]+?)--><\!--\/product_options_json-->/', $productHtml, $matches)) {
            $productOptions = json_decode($matches[1], true);
            $productHtml = str_replace($matches[0], '', $productHtml);
        }
        if (isset($productOptions['source']) && $productOptions['source']) {
            $options = array('productId' => $productOptions['source']);
        } else {
            $options = array('categoryName' => 'Recent products');
        }
        $options['pageId'] = $this->_pageId;
        $products = array_slice($this->_getProducts($options), 0, 1);
        $productHtml = $this->processProductItem($productHtml, $products);
        $productHtml = '<div class="product-container">' . $productHtml . '</div>';
        if (!$this->_productName) {
            $productHtml .= $this->_appendJsonLd($products);
        }
        return $productHtml;
    }

    /**
     * Append product json ld
     *
     * @param array $products Product collection
     *
     * @return mixed
     */
    private function _appendJsonLd($products) {
        $jsonLd = '';
        if (count($products) < 1) {
            return $jsonLd;
        }
        $product = $products[0];
        $availability = ($product['product-item']->product_in_stock - $product['product-item']->product_ordered) < 1 ? 'OutOfStock' : 'InStock';
        $priceCurrency = ShopFunctions::getCurrencyByID(CurrencyDisplay::getInstance()->getCurrencyForDisplay(), 'currency_code_3');
        $price = '';
        if ($product['product-price']) {
            $parts = explode(' ', $product['product-price']);
            $price = $parts[0];
        }
        ob_start();
        ?>
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Product",
                "name": <?php echo json_encode(strip_tags($product['product-title'])); ?>,
    "image": "<?php echo $product['product-image']; ?>",
    "description": <?php echo json_encode(strip_tags($product['product-desc'])); ?>,
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/<?php echo $availability; ?>",
        "url": "<?php echo $product['product-title-link']; ?>",
        "itemCondition": "NewCondition",
        "priceCurrency": "<?php echo $priceCurrency; ?>",
        "price": "<?php echo $price; ?>"
    }
}
        </script>
        <?php
        $jsonLd = ob_get_clean();
        return $jsonLd;
    }

    /**
     * Process product item
     *
     * @param string $html     Wrapper html
     * @param array  $products Product collection
     *
     * @return string|string[]|null
     */
    public function processProductItem($html, $products) {
        $reProductItem = '/<\!--product_item-->([\s\S]+?)<\!--\/product_item-->/';
        preg_match_all($reProductItem, $html, $matches, PREG_SET_ORDER);
        $allTemplates = count($matches);
        if ($allTemplates > 0) {
            $productsHtml = '';
            $i = 0;
            while (count($products) > 0) {
                $tmplIndex = $i % $allTemplates;
                $productItemHtml = $matches[$tmplIndex][1];
                $productItemHtml = str_replace('u-products-item ', 'u-products-item product ', $productItemHtml);
                $productItemHtml = str_replace('u-product ', 'u-product product ', $productItemHtml);
                $this->_product = array_shift($products);
                $productItemHtml = preg_replace_callback('/<\!--product_title-->([\s\S]+?)<\!--\/product_title-->/', array(&$this, '_setTitleData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_content-->([\s\S]+?)<\!--\/product_content-->/', array(&$this, '_setTextData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_description-->([\s\S]+?)<\!--\/product_description-->/', array(&$this, '_setDescriptionData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_image-->([\s\S]+?)<\!--\/product_image-->/', array(&$this, '_setImageData'), $productItemHtml);

                $this->_quantityExists = false;
                $productItemHtml = preg_replace_callback('/<\!--product_quantity-->([\s\S]+?)<\!--\/product_quantity-->/', array(&$this, '_setQuantityData'), $productItemHtml);

                $productItemHtml = preg_replace_callback('/<\!--product_button-->([\s\S]+?)<\!--\/product_button-->/', array(&$this, '_setButtonData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_price-->([\s\S]+?)<\!--\/product_price-->/', array(&$this, '_setPriceData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_gallery-->([\s\S]+?)<\!--\/product_gallery-->/', array(&$this, '_setGalleryData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_variations-->([\s\S]+?)<\!--\/product_variations-->/', array(&$this, '_setVariationsData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_tabs-->([\s\S]+?)<\!--\/product_tabs-->/', array(&$this, '_setTabsData'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_badge-->([\s\S]+?)<\!--\/product_badge-->/', array(&$this, '_setProductBadge'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_category-->([\s\S]+?)<\!--\/product_category-->/', array(&$this, '_setProductCategory'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_outofstock-->([\s\S]+?)<\!--\/product_outofstock-->/', array(&$this, '_setProductOutOfStock'), $productItemHtml);
                $productItemHtml = preg_replace_callback('/<\!--product_sku-->([\s\S]+?)<\!--\/product_sku-->/', array(&$this, '_setProductSku'), $productItemHtml);
                $productsHtml .= $productItemHtml;
                $i++;
            }
            $html = preg_replace($reProductItem, $productsHtml, $html, 1);
            $html = preg_replace($reProductItem, '', $html);
        }
        return $html;
    }

    /**
     * Get products by source
     *
     * @param array $options Source options
     *
     * @return array
     */
    private function _getProducts($options)
    {
        $model = $this->_getModel($options);
        return $model->getProducts();
    }

    /**
     * Get categories from model
     *
     * @return array
     */
    private function _getCategories()
    {
        $model = $this->_getModel();
        return $model->getCategories();
    }

    /**
     * Get model
     *
     * @param array $options Options
     *
     * @return ContentModelCustomProducts|ContentModelCustomSiteProducts
     */
    private function _getModel($options = array()) {
        if ($this->_productName) {
            $model = new ContentModelCustomSiteProducts(
                array(
                    'name' => $this->_productName,
                    'pageId' => $this->_pageId,
                )
            );
        } else {
            $model = new ContentModelCustomProducts($options);
        }
        return $model;
    }

    /**
     * Set title
     *
     * @param string $titleMatch Title match
     *
     * @return mixed|string|string[]|null
     */
    private function _setTitleData($titleMatch) {
        $titleHtml = $titleMatch[1];
        $titleHtml = preg_replace_callback(
            '/<\!--product_title_content-->([\s\S]+?)<\!--\/product_title_content-->/',
            function ($titleContentMatch) {
                return isset($this->_product['product-title']) ? $this->_product['product-title'] : $titleContentMatch[1];
            },
            $titleHtml
        );
        $titleLink = isset($this->_product['product-title-link']) ? $this->_product['product-title-link'] : '#';
        $titleHtml = preg_replace('/(href=[\'"])([\s\S]+?)([\'"])/', '$1' . $titleLink . '$3', $titleHtml);
        return $titleHtml;
    }

    /**
     * Set text
     *
     * @param string $textMatch Text match
     *
     * @return mixed|string|string[]|null
     */
    private function _setTextData($textMatch) {
        $textHtml = $textMatch[1];
        $textHtml = preg_replace_callback(
            '/<\!--product_content_content-->([\s\S]+?)<\!--\/product_content_content-->/',
            function ($contentMatch) {
                return isset($this->_product['product-desc']) ? $this->_product['product-desc'] : $contentMatch[1];
            },
            $textHtml
        );
        return $textHtml;
    }

    /**
     * Set desc
     *
     * @param array $descMatch Desc match
     *
     * @return array|string|string[]|null
     */
    private function _setDescriptionData($descMatch) {
        $descHtml = $descMatch[1];
        $descHtml = preg_replace_callback(
            '/<\!--product_description_content-->([\s\S]+?)<\!--\/product_description_content-->/',
            function ($contentMatch) {
                return isset($this->_product['product-full-desc']) ? $this->_product['product-full-desc'] : $contentMatch[1];
            },
            $descHtml
        );
        return $descHtml;
    }

    /**
     * Set product image
     *
     * @param string $imageMatch Image match
     *
     * @return mixed
     */
    private function _setImageData($imageMatch) {
        $imageHtml = $imageMatch[1];

        if ($this->_siteProductsProcessing) {
            return preg_replace_callback(
                '/href=[\"\']{1}(product-?\d+)[\"\']{1}/',
                function ($hrefMatch) {
                    $productViewPath = Uri::root() . 'index.php?option=com_nicepage&view=product';
                    return 'href="' . $productViewPath . '&page_id=' . $this->_pageId . '&product_name=' . $hrefMatch[1] . '"';
                },
                $imageHtml
            );
        }

        $isBackgroundImage = strpos($imageHtml, '<div') !== false ? true : false;

        $link = isset($this->_product['product-title-link']) ? $this->_product['product-title-link'] : '';
        $src = isset($this->_product['product-image']) ? $this->_product['product-image'] : '';

        if (!$src) {
            return $isBackgroundImage ? $imageHtml : '<div class="none-post-image" style="display: none;"></div>';
        }

        if ($isBackgroundImage) {
            $imageHtml = str_replace('<div', '<div data-product-control="' . $link . '"', $imageHtml);
            if (strpos($imageHtml, 'data-bg') !== false) {
                $imageHtml = preg_replace('/(data-bg=[\'"])([\s\S]+?)([\'"])/', '$1url(' . $this->_product['product-image'] . ')$3', $imageHtml);
            } else {
                $imageHtml = str_replace('<div', '<div' . ' style="background-image:url(' . $this->_product['product-image'] . ')"', $imageHtml);
            }
        } else {
            $imageHtml = preg_replace('/(src=[\'"])([\s\S]+?)([\'"])/', '$1' . $this->_product['product-image'] . '$3 style="cursor:pointer;" data-product-control="' . $link . '"', $imageHtml);
        }

        return $imageHtml;
    }

    /**
     * Set tabs data
     *
     * @param array $quantityMatch Quantity match
     *
     * @return mixed|string|string[]|null
     */
    private function _setQuantityData($quantityMatch) {
        $quantityHtml = $quantityMatch[1];

        if ($this->_product['product-quantity-notify']) {
            return $this->_product['product-quantity-notify'];
        }

        if (!$this->_product['product-quantity-html']) {
            return '';
        }

        $quantityHtml = preg_replace_callback(
            '/<\!--product_quantity_label_content-->([\s\S]+?)<\!--\/product_quantity_label_content-->/',
            function ($quantityLabelContentMatch) {
                return isset($this->_product['product-quantity-label']) ? $this->_product['product-quantity-label'] : $quantityLabelContentMatch[1];
            },
            $quantityHtml
        );

        $quantityHtml = preg_replace_callback(
            '/<\!--product_quantity_input-->([\s\S]+?)<\!--\/product_quantity_input-->/',
            function ($quantityInputMatch) {
                $quantityInputHtml = $quantityInputMatch[1];
                preg_match('/class=[\'"](.*?)[\'"]/', $quantityInputHtml, $inputClassMatch);
                $newQuantityInputHtml = str_replace('js-recalculate', 'js-recalculate ' . $inputClassMatch[1], $this->_product['product-quantity-html']);
                $newQuantityInputHtml = str_replace('quantity-input', '', $newQuantityInputHtml);
                return $newQuantityInputHtml;
            },
            $quantityHtml
        );

        $quantityHtml = str_replace('minus', 'quantity-minus', $quantityHtml);
        $quantityHtml = str_replace('plus', 'quantity-plus', $quantityHtml);
        $quantityHtml = str_replace('disabled', '', $quantityHtml);

        $this->_quantityExists = true;

        return $quantityHtml;
    }

    /**
     * Set product category
     *
     * @param array $categoryMatch Category match
     *
     * @return mixed
     */
    private function _setProductCategory($categoryMatch) {
        $categoryHtml = $categoryMatch[1];
        if ($this->_siteProductsProcessing) {
            return preg_replace_callback(
                '/href=[\"\']{1}product-?\d+#category-(\d+)[\"\']{1}/',
                function ($hrefMatch) {
                    $categoryViewPath = Uri::root() . 'index.php?option=com_nicepage&view=product';
                    return 'href="' . $categoryViewPath . '&page_id=' . $this->_pageId . '&product_name=product-list&catid=' . $hrefMatch[1] . '"';
                },
                $categoryHtml
            );
        }

        return preg_replace_callback(
            '/<\!--product_category_link-->([\s\S]+?)<\!--\/product_category_link-->/',
            function ($linkMatch) {
                if (count($this->_product['product-categories']) < 1) {
                    return '';
                }
                $linkHtml = $linkMatch[1];
                $categories = $this->_product['product-categories'];
                $result = '';
                foreach ($categories as $i => $category) {
                    $newCategoryHtml = preg_replace('/(href=[\'"])([\s\S]+?)([\'"])/', '$1' . $category->id . '$3', $linkHtml);
                    $title = ($i > 0 ? ', ' : '') . $category->title;
                    $newCategoryHtml = preg_replace('/<\!--product_category_link_content-->([\s\S]+?)<\!--\/product_category_link_content-->/', $title, $newCategoryHtml);
                    $result .= $newCategoryHtml;
                }
                $this->_product['product-categories'] = array();
                return $result;
            },
            $categoryHtml
        );
    }

    /**
     * Set product badge
     *
     * @param array $badgeMatch Badge match
     *
     * @return mixed
     */
    private function _setProductBadge($badgeMatch) {
        $badgeHtml = $badgeMatch[1];
        if (preg_match('/data-badge-source="sale"/', $badgeHtml)) {
            if ($this->_product['product-sale']) {
                return preg_replace_callback(
                    '/<\!--product_badge_content-->([\s\S]+?)<\!--\/product_badge_content-->/',
                    function ($badgeContentMatch) {
                        return $this->_product['product-sale'];
                    },
                    $badgeHtml
                );
            }
        } else {
            if ($this->_product['product-is-new']) {
                return $badgeHtml;
            }
        }
        return str_replace('class="', 'class="u-hidden-block ', $badgeHtml);
    }

    /**
     * Set product outofstock
     *
     * @param array $outOfStockMatch OutOfStock match
     *
     * @return mixed
     */
    private function _setProductOutOfStock($outOfStockMatch) {
        $outOfStockHtml = $outOfStockMatch[1];
        if ($this->_product['product-out-of-stock']) {
            return $outOfStockHtml;
        }
        return str_replace('class="', 'class="u-hidden-block ', $outOfStockHtml);
    }

    /**
     * Set product sku
     *
     * @param array $skuMatch Sku match
     *
     * @return array|string|string[]|null
     */
    private function _setProductSku($skuMatch) {
        $skuHtml = $skuMatch[1];
        return preg_replace_callback(
            '/<\!--product_sku_content-->([\s\S]+?)<\!--\/product_sku_content-->/',
            function () {
                return $this->_product['product-sku'];
            },
            $skuHtml
        );
    }

    /**
     * Set product button
     *
     * @param array $buttonMatch Image match
     *
     * @return mixed
     */
    private function _setButtonData($buttonMatch) {
        $buttonHtml = $buttonMatch[1];

        if ($this->_productName) {
            $buttonHtml = str_replace('data-product-id=""', 'data-product-id="' . $this->_product['product-id']  . '"', $buttonHtml);
            $buttonHtml = str_replace('<a', '<a data-product="' . $this->_product['product-json']  . '"', $buttonHtml);
            return $buttonHtml;
        }

        if ($this->_siteProductsProcessing) {
            return preg_replace_callback(
                '/href=[\"\']{1}(product-?\d+)[\"\']{1}/',
                function ($hrefMatch) {
                    $productViewPath = Uri::root() . 'index.php?option=com_nicepage&view=product';
                    return 'href="' . $productViewPath . '&page_id=' . $this->_pageId . '&product_name=' . $hrefMatch[1] . '"';
                },
                $buttonHtml
            );
        }

        if ($this->_product['product-button-text'] === 'product-template') {
            return $buttonHtml;
        }

        $isOnlyCatalog = !$this->_product['product-button-text'] ? true : false;
        if ($isOnlyCatalog) {
            return '';
        }
        $buttonHtml = $buttonMatch[1];
        $controlOptions = array();
        if (preg_match('/<\!--options_json--><\!--([\s\S]+?)--><\!--\/options_json-->/', $buttonHtml, $matches)) {
            $controlOptions = json_decode($matches[1], true);
            $buttonHtml = str_replace($matches[0], '', $buttonHtml);
        }
        $goToProduct = false;
        if (isset($controlOptions['clickType']) && $controlOptions['clickType'] === 'go-to-page') {
            $goToProduct = true;
        }
        if ($this->_product['product-button-html'] && isset($controlOptions['content']) && $controlOptions['content']) {
            $this->_product['product-button-text'] = $controlOptions['content'];
        }
        $buttonHtml = preg_replace_callback(
            '/<\!--product_button_content-->([\s\S]+?)<\!--\/product_button_content-->/',
            function ($buttonContentMatch) {
                return isset($this->_product['product-button-text']) ? $this->_product['product-button-text'] : $buttonContentMatch[1];
            },
            $buttonHtml
        );
        if ($this->_product['product-button-html'] && !$goToProduct) {
            $buttonHtml = str_replace('[[button]]', $buttonHtml, $this->_product['product-button-html']);
            $defaultQuantityHtml = '<input type="hidden" class="quantity-input js-recalculate" name="quantity[]" value="1">';
            $buttonHtml = str_replace('[[quantity]]', !$this->_quantityExists ? $defaultQuantityHtml : '', $buttonHtml);
            $buttonHtml = str_replace('<a', '<a name="addtocart"', $buttonHtml);
            $buttonLink = '#';
        } else {
            $buttonLink = $this->_product['product-button-link'];
        }
        $buttonHtml = preg_replace('/(href=[\'"])([\s\S]+?)([\'"])/', '$1' . $buttonLink . '$3', $buttonHtml);

        vmJsApi::jPrice();
        vmJsApi::cssSite();
        vmJsApi::jDynUpdate();

        $buttonHtml .= vmJsApi::writeJS();
        return $buttonHtml;
    }

    /**
     * Set product price
     *
     * @param array $priceMatch Price match
     *
     * @return mixed|string|string[]|null
     */
    private function _setPriceData($priceMatch) {
        $priceHtml = $priceMatch[1];
        $this->_addZeroCents = strpos($priceHtml, 'data-add-zero-cents="true"') !== false ? true : false;

        $priceHtml = preg_replace_callback(
            '/<\!--product_regular_price-->([\s\S]+?)<\!--\/product_regular_price-->/',
            function ($regularPriceMatch) {
                if ($this->_product['product-price']) {
                    $price = preg_quote($this->_product['product-price']);
                    $price = $this->addZeroCentsProcess($price, $this->_addZeroCents);
                    return preg_replace('/<\!--product_regular_price_content-->([\s\S]+?)<\!--\/product_regular_price_content-->/', $price, $regularPriceMatch[1]);
                } else {
                    return '';
                }
            },
            $priceHtml
        );

        $priceHtml = preg_replace_callback(
            '/<\!--product_old_price-->([\s\S]+?)<\!--\/product_old_price-->/',
            function ($oldPriceMatch) {
                $oldPrice = preg_quote($this->_product['product-old-price']);
                $oldPrice = $this->addZeroCentsProcess($oldPrice, $this->_addZeroCents);
                if ($this->_product['product-old-price'] && $this->_product['product-old-price'] !== $this->_product['product-price']) {
                    return preg_replace('/<\!--product_old_price_content-->([\s\S]+?)<\!--\/product_old_price_content-->/', $oldPrice, $oldPriceMatch[1]);
                } else {
                    return '';
                }
            },
            $priceHtml
        );

        return $priceHtml;
    }

    /**
     * Set gallery data
     *
     * @param array $galleryMatch Gallery match
     *
     * @return string
     */
    private function _setGalleryData($galleryMatch) {
        $galleryHtml = $galleryMatch[1];
        $galleryData = $this->_product['product-gallery'];

        if (count($galleryData) < 1) {
            return '';
        }

        $controlOptions = array();
        if (preg_match('/<\!--options_json--><\!--([\s\S]+?)--><\!--\/options_json-->/', $galleryHtml, $matches)) {
            $controlOptions = json_decode($matches[1], true);
            $galleryHtml = str_replace($matches[0], '', $galleryHtml);
        }

        $maxItems = -1;
        if (isset($controlOptions['maxItems']) && $controlOptions['maxItems']) {
            $maxItems = (int) $controlOptions['maxItems'];
        }

        if ($maxItems !== -1 && count($galleryData) > $maxItems) {
            $galleryData = array_slice($galleryData, 0, $maxItems);
        }

        $galleryItemRe = '/<\!--product_gallery_item-->([\s\S]+?)<\!--\/product_gallery_item-->/';
        preg_match($galleryItemRe, $galleryHtml, $galleryItemMatch);
        $galleryItemHtml = str_replace('u-active', '', $galleryItemMatch[1]);

        $galleryThumbnailRe = '/<\!--product_gallery_thumbnail-->([\s\S]+?)<\!--\/product_gallery_thumbnail-->/';
        $galleryThumbnailHtml = '';
        if (preg_match($galleryThumbnailRe, $galleryHtml, $galleryThumbnailMatch)) {
            $galleryThumbnailHtml = $galleryThumbnailMatch[1];
        }

        $newGalleryItemListHtml = '';
        $newThumbnailListHtml = '';
        foreach ($galleryData as $key => $img) {
            $newGalleryItemHtml = $key == 0 ? str_replace('u-gallery-item', 'u-gallery-item u-active', $galleryItemHtml) : $galleryItemHtml;
            $newGalleryItemListHtml .= preg_replace('/(src=[\'"])([\s\S]+?)([\'"])/', '$1' . $img . '$3', $newGalleryItemHtml);
            if ($galleryThumbnailHtml) {
                $newThumbnailHtml = preg_replace('/data-u-slide-to=([\'"])([\s\S]+?)([\'"])/', 'data-u-slide-to="' . $key . '"', $galleryThumbnailHtml);
                $newThumbnailListHtml .= preg_replace('/(src=[\'"])([\s\S]+?)([\'"])/', '$1' . $img . '$3', $newThumbnailHtml);
            }
        }

        $galleryParts = preg_split($galleryItemRe, $galleryHtml, -1, PREG_SPLIT_NO_EMPTY);
        $newGalleryHtml = $galleryParts[0] . $newGalleryItemListHtml . $galleryParts[1];

        $newGalleryParts = preg_split($galleryThumbnailRe, $newGalleryHtml, -1, PREG_SPLIT_NO_EMPTY);
        return $newGalleryParts[0] . $newThumbnailListHtml . $newGalleryParts[1];
    }

    /**
     * Set variations data
     *
     * @param array $variationsMatch Variations match
     *
     * @return mixed|string|string[]|null
     */
    private function _setVariationsData($variationsMatch) {
        $variationsHtml = $variationsMatch[1];
        $variationsData = $this->_product['product-variations'];

        if (count($variationsData) < 1) {
            return '';
        }

        $variationRe = '/<\!--product_variation-->([\s\S]+?)<\!--\/product_variation-->/';
        preg_match($variationRe, $variationsHtml, $variationMatch);

        $newVariationListHtml = '';
        foreach ($variationsData as $i => $variationData) {
            $newVariationHtml = str_replace('<select', '<select ' . $variationData['s_attributes'], $variationMatch[1]);
            $newVariationHtml = str_replace('u-input ', 'u-input ' . $variationData['s_classes'] . ' ', $newVariationHtml);
            $newVariationHtml = preg_replace('/<\!--product_variation_label_content-->([\s\S]+?)<\!--\/product_variation_label_content-->/', $variationData['title'], $newVariationHtml);
            preg_match('/<\!--product_variation_option-->([\s\S]+?)<\!--\/product_variation_option-->/', $newVariationHtml, $optionMatch);
            $optionHtml = $optionMatch[1];

            $options = $variationData['options'];
            $newOptionsHtml = '';
            foreach ($options as $option) {
                $newOptionHtml = preg_replace('/<\!--product_variation_option_content-->([\s\S]+?)<\!--\/product_variation_option_content-->/', $option['text'], $optionHtml);
                if ($option['selected']) {
                    $newOptionHtml = str_replace('<option', '<option selected="selected"', $newOptionHtml);
                }
                $newOptionHtml = preg_replace('/(value=[\'"])([\s\S]+?)([\'"])/', '$1[[value]]$3', $newOptionHtml);
                $newOptionHtml = str_replace('[[value]]', $option['value'], $newOptionHtml);
                $newOptionsHtml .= $newOptionHtml;
            }
            if ($i !== 0) {
                $newVariationHtml = '<div style="margin-top: 10px;">' . $newVariationHtml . '</div>';
            }
            $newVariationParts = preg_split('/<\!--product_variation_option-->([\s\S]+?)<\!--\/product_variation_option-->/', $newVariationHtml, -1, PREG_SPLIT_NO_EMPTY);
            $newVariationListHtml .= $newVariationParts[0] . $newOptionsHtml . $newVariationParts[1];
        }

        $variationsParts = preg_split($variationRe, $variationsHtml, -1, PREG_SPLIT_NO_EMPTY);
        $newVariationsHtml = $variationsParts[0] . $newVariationListHtml . $variationsParts[1];
        $newVariationsHtml = str_replace('u-product-variations ', 'u-product-variations product-field-display ', $newVariationsHtml);
        return $newVariationsHtml;
    }

    /**
     * Set tabs data
     *
     * @param array $tabsMatch Tabs match
     *
     * @return mixed|string|string[]|null
     */
    private function _setTabsData($tabsMatch) {
        $tabsHtml = $tabsMatch[1];
        $tabsData = $this->_product['product-tabs'];

        if (count($tabsData) < 1) {
            return '';
        }

        $tabItemRe = '/<\!--product_tabitem-->([\s\S]+?)<\!--\/product_tabitem-->/';
        preg_match($tabItemRe, $tabsHtml, $tabItemMatch);
        $tabItemLinkClassRe = '/(class=[\'"])(.*?u-tab-link.*?)([\'"])/';
        preg_match($tabItemLinkClassRe, $tabItemMatch[1], $tabItemLinkClassMatch);
        $classesParts = explode(' ', $tabItemLinkClassMatch[2]);
        $key = array_search('active', $classesParts);
        if ($key !== false) {
            array_splice($classesParts, $key, 1);
        }
        $tabItemHtml = preg_replace($tabItemLinkClassRe, '$1' . implode(' ', $classesParts) . '$3', $tabItemMatch[1]);

        $tabPaneRe = '/<\!--product_tabpane-->([\s\S]+?)<\!--\/product_tabpane-->/';
        preg_match($tabPaneRe, $tabsHtml, $tabPaneMatch);
        $tabPaneHtml = str_replace('u-tab-active', '', $tabPaneMatch[1]);

        $newTabItemListHtml = '';
        $newTabPaneListHtml = '';
        foreach ($tabsData as $key => $tab) {
            $newTabItemHtml = preg_replace('/<\!--product_tabitem_title-->([\s\S]+?)<\!--\/product_tabitem_title-->/', $tab['title'], $tabItemHtml);
            $newTabItemHtml = $key == 0 ? str_replace('u-tab-link', 'u-tab-link active', $newTabItemHtml) : $newTabItemHtml;
            $newTabItemHtml = preg_replace('/(id=[\'"])([\s\S]+?)([\'"])/', '$1tab-' . $tab['guid'] . '$3', $newTabItemHtml);
            $newTabItemHtml = preg_replace('/(href=[\'"])([\s\S]+?)([\'"])/', '$1#link-tab-' . $tab['guid'] . '$3', $newTabItemHtml);
            $newTabItemHtml = preg_replace('/(aria-controls=[\'"])([\s\S]+?)([\'"])/', '$1link-tab-' . $tab['guid'] . '$3', $newTabItemHtml);
            $newTabItemListHtml .= $newTabItemHtml;

            $newTabPaneHtml = $key == 0 ? str_replace('u-tab-pane', 'u-tab-pane u-tab-active', $tabPaneHtml) : $tabPaneHtml;
            $newTabPaneHtml = preg_replace('/(id=[\'"])([\s\S]+?)([\'"])/', '$1link-tab-' . $tab['guid'] . '$3', $newTabPaneHtml);
            $newTabPaneHtml = preg_replace('/(aria-labelledby=[\'"])([\s\S]+?)([\'"])/', '$1tab-' . $tab['guid'] . '$3', $newTabPaneHtml);
            $newTabPaneHtml = preg_replace('/<\!--product_tabpane_content-->([\s\S]+?)<\!--\/product_tabpane_content-->/', $tab['content'], $newTabPaneHtml);
            $newTabPaneListHtml .= $newTabPaneHtml;
        }

        $tabsParts = preg_split($tabItemRe, $tabsHtml, -1, PREG_SPLIT_NO_EMPTY);
        $newTabsHtml = $tabsParts[0] . $newTabItemListHtml . $tabsParts[1];

        $tabsParts = preg_split($tabPaneRe, $newTabsHtml, -1, PREG_SPLIT_NO_EMPTY);
        return $tabsParts[0] . $newTabPaneListHtml . $tabsParts[1];
    }

    /**
     * Get price with/without cents
     *
     * @param string $price
     * @param bool   $addZeroCents
     *
     * @return string $price
     */
    public function addZeroCentsProcess($price, $addZeroCents = false) {
        $separator = strpos($price, ',') > -1 ? ',' : '.';
        $currentPrice = '0';
        $price = str_replace('\\', '', $price);
        if (preg_match('/\d+(' . $separator . '\d+)?/', $price, $matches)) {
            $currentPrice = $matches[0];
            $price = str_replace($matches[0], '[[currentPrice]]', $price);
        }
        $priceParams = explode($separator, $currentPrice);
        $cents = isset($priceParams[1]) ? $priceParams[1] : '00';
        if ($cents === '00') {
            $currentPrice = $priceParams[0];
        }
        if ($addZeroCents) {
            $currentPrice = $priceParams[0] . $separator . $cents;
        }
        return str_replace('[[currentPrice]]', $currentPrice, $price);
    }
}
