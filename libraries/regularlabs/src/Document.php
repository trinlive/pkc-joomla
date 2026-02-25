<?php
/**
 * @package         Regular Labs Library
 * @version         24.1.10020
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2024 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

namespace RegularLabs\Library;

defined('_JEXEC') or die;

use Joomla\CMS\Document\Document as JDocument;
use Joomla\CMS\Factory as JFactory;
use Joomla\CMS\HTML\HTMLHelper as JHtml;
use Joomla\CMS\Language\Text as JText;
use Joomla\CMS\WebAsset\WebAssetManager as JWebAssetManager;

class Document
{
    public static function adminError(string $message): void
    {
        self::adminMessage($message, 'error');
    }

    public static function adminMessage(string $message, string $type = 'message'): void
    {
        if ( ! self::isAdmin())
        {
            return;
        }

        self::message($message, $type);
    }

    public static function error(string $message): void
    {
        self::message($message, 'error');
    }

    public static function get(): JDocument
    {
        $document = JFactory::getApplication()->getDocument();

        if ( ! is_null($document))
        {
            return $document;
        }

        JFactory::getApplication()->loadDocument();

        return JFactory::getApplication()->getDocument();
    }

    public static function getAssetManager(): ?JWebAssetManager
    {
        $document = self::get();

        if (is_null($document))
        {
            return null;
        }

        return $document->getWebAssetManager();
    }

    public static function getComponentBuffer(): ?string
    {
        $buffer = self::get()->getBuffer('component');

        if (empty($buffer) || ! is_string($buffer))
        {
            return null;
        }

        $buffer = trim($buffer);

        if (empty($buffer))
        {
            return null;
        }

        return $buffer;
    }

    public static function isAdmin(bool $exclude_login = false): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $user = JFactory::getApplication()->getIdentity() ?: JFactory::getUser();

        $is_admin = (
            self::isClient('administrator')
            && ( ! $exclude_login || ! $user->get('guest'))
            && Input::get('task', '') != 'preview'
            && ! (
                Input::get('option', '') == 'com_finder'
                && Input::get('format', '') == 'json'
            )
        );

        return $cache->set($is_admin);
    }

    public static function isCategoryList(string $context): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        // Return false if it is not a category page
        if ($context != 'com_content.category' || Input::get('view', '') != 'category')
        {
            return $cache->set(false);
        }

        // Return false if layout is set and it is not a list layout
        if (Input::get('layout', '') && Input::get('layout', '') != 'list')
        {
            return $cache->set(false);
        }

        // Return false if default layout is set to blog
        if (JFactory::getApplication()->getParams()->get('category_layout') == '_:blog')
        {
            return $cache->set(false);
        }

        // Return true if it IS a list layout
        return $cache->set(true);
    }

    public static function isCli(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_cli = (new MobileDetect)->isCurl();

        return $cache->set($is_cli);
    }

    public static function isClient(string $identifier): bool
    {
        $identifier = $identifier == 'admin' ? 'administrator' : $identifier;

        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        return $cache->set(JFactory::getApplication()->isClient($identifier));
    }

    public static function isDebug(): bool
    {
        return JFactory::getApplication()->get('debug') || Input::get('debug');
    }

    public static function isEditPage(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $option = Input::get('option', '');

        // always return false for these components
        if (in_array($option, ['com_rsevents', 'com_rseventspro'], true))
        {
            return $cache->set(false);
        }

        $task = Input::get('task', '');

        if (str_contains($task, '.'))
        {
            $task = explode('.', $task);
            $task = array_pop($task);
        }

        $view = Input::get('view', '');

        if (str_contains($view, '.'))
        {
            $view = explode('.', $view);
            $view = array_pop($view);
        }

        $is_edit_page = (
            in_array($option, ['com_config', 'com_contentsubmit', 'com_cckjseblod'], true)
            || ($option == 'com_comprofiler' && in_array($task, ['', 'userdetails'], true))
            || in_array($task, ['edit', 'form', 'submission'], true)
            || in_array($view, ['edit', 'form'], true)
            || in_array(Input::get('do', ''), ['edit', 'form'], true)
            || in_array(Input::get('layout', ''), ['edit', 'form', 'write'], true)
            || self::isAdmin()
        );

        return $cache->set($is_edit_page);
    }

    public static function isFeed(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_feed = (
            self::get()->getType() == 'feed'
            || in_array(Input::getWord('format'), ['feed', 'xml'], true)
            || in_array(Input::getWord('type'), ['rss', 'atom'], true)
        );

        return $cache->set($is_feed);
    }

    public static function isHtml(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_html = (self::get()->getType() == 'html');

        return $cache->set($is_html);
    }

    public static function isHttps(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_https = (
            ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off')
            || (isset($_SERVER['SSL_PROTOCOL']))
            || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https')
        );

        return $cache->set($is_https);
    }

    public static function isJSON(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_json = Input::get('format', '') == 'json';

        return $cache->set($is_json);
    }

    /**
     * Check if the current setup matches the given main version number
     */
    public static function isJoomlaVersion(int $version, string $title = ''): bool
    {
        $jversion = Version::getMajorJoomlaVersion();

        if ($jversion == $version)
        {
            return true;
        }

        if ($title && self::isAdmin())
        {
            Language::load('plg_system_regularlabs');

            JFactory::getApplication()->enqueueMessage(
                JText::sprintf('RL_NOT_COMPATIBLE_WITH_JOOMLA_VERSION', JText::_($title), $jversion),
                'error'
            );
        }

        return false;
    }

    public static function isPDF(): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        $is_pdf = (
            self::get()->getType() == 'pdf'
            || Input::getWord('format') == 'pdf'
            || Input::getWord('cAction') == 'pdf'
        );

        return $cache->set($is_pdf);
    }

    public static function message(string $message, string $type = 'message'): void
    {
        Language::load('plg_system_regularlabs');

        JFactory::getApplication()->enqueueMessage($message, $type);
    }

    /**
     * @depecated Use RegularLabs\Library\StringHelper::minify()
     */
    public static function minify(string $string): string
    {
        return StringHelper::minify($string);
    }

    public static function removeScriptTag(string &$string, string $folder, string $name): void
    {
        $regex_name = RegEx::quote($name);
        $regex_name = str_replace('\*', '[^"]*', $regex_name);

        $string = RegEx::replace('\s*<script [^>]*href="[^"]*(' . $folder . '/js|js/' . $folder . ')/' . $regex_name . '\.[^>]*( /)?>', '', $string);
    }

    public static function removeScriptsOptions(
        string &$string,
        string $name,
        string $alias = ''
    ): void
    {
        RegEx::match(
            '(<script type="application/json" class="joomla-script-options new">)(.*?)(</script>)',
            $string,
            $match
        );

        if (empty($match))
        {
            return;
        }

        $alias = $alias ?: Extension::getAliasByName($name);

        $scripts = json_decode($match[2]);

        if ( ! isset($scripts->{'rl_' . $alias}))
        {
            return;
        }

        unset($scripts->{'rl_' . $alias});

        $string = str_replace(
            $match[0],
            $match[1] . json_encode($scripts) . $match[3],
            $string
        );
    }

    public static function removeScriptsStyles(
        string &$string,
        string $name,
        string $alias = ''
    ): void
    {
        [$start, $end] = Protect::getInlineCommentTags($name, null, true);
        $alias = $alias ?: Extension::getAliasByName($name);

        $string = RegEx::replace('((?:;\s*)?)(;?)' . $start . '.*?' . $end . '\s*', '\1', $string);
        $string = RegEx::replace('\s*<link [^>]*href="[^"]*/(' . $alias . '/css|css/' . $alias . ')/[^"]*\.css[^"]*"[^>]*( /)?>', '', $string);
        $string = RegEx::replace('\s*<script [^>]*src="[^"]*/(' . $alias . '/js|js/' . $alias . ')/[^"]*\.js[^"]*"[^>]*></script>', '', $string);
        $string = RegEx::replace('\s*<script></script>', '', $string);
    }

    public static function removeStyleTag(string &$string, string $folder, string $name): void
    {
        $name = RegEx::quote($name);
        $name = str_replace('\*', '[^"]*', $name);

        $string = RegEx::replace('\s*<link [^>]*href="[^"]*(' . $folder . '/css|css/' . $folder . ')/' . $name . '\.[^>]*( /)?>', '', $string);
    }

    public static function script(
        string $name,
        array  $attributes = ['defer' => true],
        array  $dependencies = [],
        bool   $convert_dots = true
    ): void
    {
        $file = $name;

        if ($convert_dots)
        {
            $file = str_replace('.', '/', $file) . '.min.js';
        }

        self::getAssetManager()->registerAndUseScript(
            $name,
            $file,
            [],
            $attributes,
            $dependencies
        );
    }

    public static function scriptDeclaration(
        string $content = '',
        string $name = '',
        bool   $minify = true,
        string $position = 'before'
    ): void
    {
        if ($minify)
        {
            $content = StringHelper::minify($content);
        }

        if ( ! empty($name))
        {
            $content = Protect::wrapScriptDeclaration($content, $name, $minify);
        }

        self::getAssetManager()->addInlineScript(
            $content,
            ['position' => $position]
        );
    }

    public static function scriptOptions(array $options = [], string $name = ''): void
    {
        JHtml::_('behavior.core');

        $alias = RegEx::replace('[^a-z0-9_-]', '', strtolower($name));
        $key   = 'rl_' . $alias;

        self::get()->addScriptOptions($key, $options);
    }

    public static function setComponentBuffer(string $buffer = ''): void
    {
        self::get()->setBuffer($buffer, 'component');
    }

    public static function style(
        string $name,
        array  $attributes = [],
        bool   $convert_dots = true
    ): void
    {
        $file = $name;

        if ($convert_dots)
        {
            $file = str_replace('.', '/', $file) . '.min.css';
        }

        self::getAssetManager()->registerAndUseStyle(
            $name,
            $file,
            [],
            $attributes
        );
    }

    public static function styleDeclaration(
        string $content = '',
        string $name = '',
        bool   $minify = true
    ): void
    {
        if ($minify)
        {
            $content = StringHelper::minify($content);
        }

        if ( ! empty($name))
        {
            $content = Protect::wrapStyleDeclaration($content, $name, $minify);
        }

        self::getAssetManager()->addInlineStyle($content);
    }

    public static function usePreset(string $name): void
    {
        self::getAssetManager()->usePreset($name);
    }

    public static function useScript(string $name): void
    {
        self::getAssetManager()->useScript($name);
    }

    public static function useStyle(string $name): void
    {
        self::getAssetManager()->useStyle($name);
    }
}
