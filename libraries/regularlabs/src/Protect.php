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

use Joomla\CMS\Access\Access as JAccess;

class Protect
{
    static $html_safe_end        = '___/RL_PROTECTED___';
    static $html_safe_start      = '___RL_PROTECTED___';
    static $html_safe_tags_end   = '___/RL_PROTECTED_TAGS___';
    static $html_safe_tags_start = '___RL_PROTECTED_TAGS___';
    static $protect_end          = '___RL_PROTECTED___ -->';
    static $protect_start        = '<!-- ___RL_PROTECTED___';
    static $protect_tags_end     = '___RL_PROTECTED_TAGS___ -->';
    static $protect_tags_start   = '<!-- ___RL_PROTECTED_TAGS___';
    static $sourcerer_characters = '{.}';
    static $sourcerer_tag;

    /**
     * Check if article passes security levels
     */
    public static function articlePassesSecurity(
        ?object      &$article,
        array|string $securtiy_levels = []
    ): bool
    {
        if ( ! isset($article->created_by))
        {
            return true;
        }

        if (empty($securtiy_levels))
        {
            return true;
        }

        if (is_string($securtiy_levels))
        {
            $securtiy_levels = [$securtiy_levels];
        }

        if ( ! is_array($securtiy_levels)
            || in_array('-1', $securtiy_levels)
        )
        {
            return true;
        }

        // Lookup group level of creator
        $user_groups = new JAccess;
        $user_groups = $user_groups->getGroupsByUser($article->created_by);

        // Return true if any of the security levels are found in the users groups
        return count(array_intersect($user_groups, $securtiy_levels)) > 0;
    }

    /**
     * Replace any protected text to original
     */
    public static function convertProtectionToHtmlSafe(string &$string): void
    {
        $string = str_replace(
            [
                self::$protect_start,
                self::$protect_end,
                self::$protect_tags_start,
                self::$protect_tags_end,
            ],
            [
                self::$html_safe_start,
                self::$html_safe_end,
                self::$html_safe_tags_start,
                self::$html_safe_tags_end,
            ],
            $string
        );
    }

    /**
     * Get the html end comment tags
     */
    public static function getCommentEndTag(string $name = ''): string
    {
        return '<!-- END: ' . $name . ' -->';
    }

    /**
     * Get the html start comment tags
     */
    public static function getCommentStartTag(string $name = ''): string
    {
        return '<!-- START: ' . $name . ' -->';
    }

    /**
     * Get the html comment tags
     */
    public static function getCommentTags(string $name = ''): array
    {
        return [self::getCommentStartTag($name), self::getCommentEndTag($name)];
    }

    /**
     * Return the Regular Expressions string to match:
     * The edit form
     */
    public static function getFormRegex(array|string $form_classes = []): string
    {
        $form_classes = ArrayHelper::toArray($form_classes);

        return '(<form\s[^>]*('
            . '(id|name)="(adminForm|postform|submissionForm|default_action_user|seblod_form|spEntryForm)"'
            . '|action="[^"]*option=com_myjspace&(amp;)?view=see"'
            . (! empty($form_classes) ? '|class="([^"]* )?(' . implode('|', $form_classes) . ')( [^"]*)?"' : '')
            . '))';
    }

    /**
     * Get the start and end parts for the inline comment tags for scripts/styles
     */
    public static function getInlineCommentTags(
        string  $name = '',
        ?string $type = '',
        bool    $regex = false
    ): array
    {
        if ($regex)
        {
            return self::getInlineCommentTagsRegEx($name, $type);
        }

        if ($type)
        {
            $type = ': ' . $type;
        }

        $start = '/* START: ' . $name . $type . ' */';
        $end   = '/* END: ' . $name . $type . ' */';

        return [$start, $end];
    }

    /**
     * Get the start and end parts for the inline comment tags for scripts/styles
     */
    public static function getInlineCommentTagsRegEx(string $name = '', ?string $type = ''): array
    {
        $name = str_replace(' ', ' ?', RegEx::quote($name));
        $type = $type ? ':? ' . RegEx::quote($type) : '(:? [a-z0-9]*)?';

        $start = '/\* START: ' . $name . $type . ' \*/';
        $end   = '/\* END: ' . $name . $type . ' \*/';

        return [$start, $end];
    }

    /**
     * Create a html comment from given comment string
     */
    public static function getMessageCommentTag(string $name, string $comment): string
    {
        [$start, $end] = self::getMessageCommentTags($name);

        return $start . $comment . $end;
    }

    /**
     * Get the start and end parts for the html message comment tag
     */
    public static function getMessageCommentTags(string $name = ''): array
    {
        return ['<!--  ' . $name . ' Message: ', ' -->'];
    }

    /**
     * Return the sourcerer tag name and characters
     */
    public static function getSourcererTag(): array
    {
        if ( ! is_null(self::$sourcerer_tag))
        {
            return [self::$sourcerer_tag, self::$sourcerer_characters];
        }

        $parameters = Parameters::getPlugin('sourcerer');

        self::$sourcerer_tag        = $parameters->syntax_word ?? '';
        self::$sourcerer_characters = $parameters->tag_characters ?? '{.}';

        return [self::$sourcerer_tag, self::$sourcerer_characters];
    }

    /**
     * Check if the component is installed
     */
    public static function isComponentInstalled(string $extension_alias): bool
    {
        return file_exists(JPATH_ADMINISTRATOR . '/components/com_' . $extension_alias . '/' . $extension_alias . '.xml');
    }

    /**
     * Check if page should be protected for given extension
     */
    public static function isDisabledByUrl(string $extension_alias = ''): bool
    {
        // return if disabled via url
        return $extension_alias
            && Input::get('disable_' . $extension_alias);
    }

    /**
     * @deprecated Use isDisabledByUrl() and isRestrictedPage()
     */
    public static function isProtectedPage(
        string $extension_alias = '',
        bool   $hastags = false,
        array  $exclude_formats = []
    ): bool
    {
        if (self::isDisabledByUrl($extension_alias))
        {
            return true;
        }

        return self::isRestrictedPage($hastags, $exclude_formats);
    }

    /**
     * Check if the page is a restricted component
     */
    public static function isRestrictedComponent(
        array|string $restricted_components,
        string       $area = 'component'
    ): bool
    {
        if ($area != 'component' && ! ($area == 'article' && Input::get('option', '') == 'com_content'))
        {
            return false;
        }

        $restricted_components = ArrayHelper::toArray(str_replace('|', ',', $restricted_components));
        $restricted_components = ArrayHelper::clean($restricted_components);

        if ( ! empty($restricted_components) && in_array(Input::get('option', ''), $restricted_components, true))
        {
            return true;
        }

        if (
            Input::get('option', '') == 'com_acymailing'
            && ! in_array(Input::get('ctrl', ''), ['user', 'archive'], true)
            && ! in_array(Input::get('view', ''), ['user', 'archive'], true)
        )
        {
            return true;
        }

        return false;
    }

    /**
     * Check if page should be protected for given extension
     */
    public static function isRestrictedPage(
        bool  $hastags = false,
        array $restricted_formats = []
    ): bool
    {
        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        // return if current page is in protected formats
        // return if current page is an image
        // return if current page is an installation page
        // return if current page is Regular Labs QuickPage
        // return if current page is a JoomFish or Josetta page
        $is_restricted = (
            in_array(Input::get('format', ''), $restricted_formats, true)
            //            || in_array(Input::get('view', ''), ['image', 'img'], true)
            || in_array(Input::get('type', ''), ['image', 'img'], true)
            || in_array(Input::get('task', ''), ['install.install', 'install.ajax_upload'], true)
            || ($hastags && Input::getInt('rl_qp', 0))
            || ($hastags && in_array(Input::get('option', ''), ['com_joomfishplus', 'com_josetta'], true))
            || (Document::isClient('administrator') && in_array(Input::get('option', ''), ['com_jdownloads'], true))
        );

        return $cache->set($is_restricted);
    }

    /**
     * Check if the component is installed
     */
    public static function isSystemPluginInstalled(string $extension_alias): bool
    {
        return file_exists(JPATH_PLUGINS . '/system/' . $extension_alias . '/' . $extension_alias . '.xml');
    }

    /**
     * Protect text by given regex
     */
    public static function protectByRegex(
        string     &$string,
        string     $regex,
        int|string $group = 0
    ): void
    {
        RegEx::matchAll($regex, $string, $matches);

        if (empty($matches))
        {
            return;
        }

        $replacements = [];

        foreach ($matches as $match)
        {
            if (isset($replacements[$match[0]]))
            {
                continue;
            }

            $replacements[$match[0]] = self::protectString($match[$group] ?? $match[0]);
        }

        $string = str_replace(array_keys($replacements), $replacements, $string);
    }

    /**
     * Protect all text based form fields
     */
    public static function protectFields(string &$string, array $search_strings = []): void
    {
        // No specified strings tags found in the string
        if ( ! self::containsStringsToProtect($string, $search_strings))
        {
            return;
        }

        $parts = StringHelper::split($string, ['</label>', '</select>']);

        foreach ($parts as &$part)
        {
            if ( ! self::containsStringsToProtect($part, $search_strings))
            {
                continue;
            }

            self::protectFieldsPart($part);
        }

        $string = implode('', $parts);
    }

    /**
     * Protect complete AdminForm
     */
    public static function protectForm(
        string       &$string,
        array        $tags = [],
        bool         $include_closing_tags = true,
        array|string $form_classes = []
    ): void
    {
        if ( ! Document::isEditPage())
        {
            return;
        }

        [$tags, $protected_tags] = self::prepareTags($tags, $include_closing_tags);

        $string = RegEx::replace(self::getFormRegex($form_classes), '<!-- TMP_START_EDITOR -->\1', $string);
        $string = explode('<!-- TMP_START_EDITOR -->', $string);

        foreach ($string as $i => &$string_part)
        {
            if (empty($string_part) || ! fmod($i, 2))
            {
                continue;
            }

            self::protectFormPart($string_part, $tags, $protected_tags);
        }

        $string = implode('', $string);
    }

    /**
     * Protect all html comment tags
     */
    public static function protectHtmlCommentTags(string &$string, array $ignores = []): void
    {
        $regex = '<\!--.*?-->';

        if ( ! empty($ignores) && StringHelper::contains($string, $ignores))
        {
            $regex = '<\!--((?!' . RegEx::quote($ignores) . ').)*-->';
        }

        self::protectByRegex($string, $regex);
    }

    /**
     * Protect all html tags with some type of attributes/content
     */
    public static function protectHtmlTags(string &$string): void
    {
        // protect comment tags
        self::protectHtmlCommentTags($string);

        // protect html tags
        self::protectByRegex($string, '<[a-z][^>]*(?:="[^"]*"|=\'[^\']*\')+[^>]*>');
    }

    /**
     * Protect the script tags
     */
    public static function protectScripts(string &$string): void
    {
        if ( ! str_contains($string, '</script>'))
        {
            return;
        }

        self::protectByRegex(
            $string,
            '<script[\s>].*?</script>'
        );
    }

    /**
     * Protect all Sourcerer blocks
     */
    public static function protectSourcerer(string &$string): void
    {
        [$tag, $characters] = self::getSourcererTag();

        if (empty($tag))
        {
            return;
        }

        [$start, $end] = explode('.', $characters);

        if ( ! str_contains($string, $start . '/' . $tag . $end))
        {
            return;
        }

        $regex = RegEx::quote($start . $tag)
            . '[\s\}].*?'
            . RegEx::quote($start . '/' . $tag . $end);

        RegEx::matchAll($regex, $string, $matches, null, PREG_PATTERN_ORDER);

        if (empty($matches))
        {
            return;
        }

        $matches = array_unique($matches[0]);

        foreach ($matches as $match)
        {
            $string = str_replace($match, self::protectString($match), $string);
        }
    }

    /**
     * Encode string
     */
    public static function protectString(string $string, bool $is_tag = false): string
    {
        if ($is_tag)
        {
            return self::$protect_tags_start . base64_encode($string) . self::$protect_tags_end;
        }

        return self::$protect_start . base64_encode($string) . self::$protect_end;
    }

    /**
     * Protect given plugin style tags
     */
    public static function protectTags(
        string &$string,
        array  $tags = [],
        bool   $include_closing_tags = true
    ): void
    {
        [$tags, $protected] = self::prepareTags($tags, $include_closing_tags);

        $string = str_replace($tags, $protected, $string);
    }

    /**
     * Remove area comments in html
     */
    public static function removeAreaTags(string &$string, string $prefix = ''): void
    {
        $string = RegEx::replace('<!-- (START|END): ' . $prefix . '_[A-Z]+ -->', '', $string, 's');
    }

    /**
     * Remove comments in html
     */
    public static function removeCommentTags(string &$string, string $name = ''): void
    {
        [$start, $end] = self::getCommentTags($name);

        $string = str_replace(
            [
                $start, $end,
                htmlentities($start), htmlentities($end),
                urlencode($start), urlencode($end),
            ], '', $string
        );

        $start = str_replace(' -->', 'REGEX_PLACEHOLDER -->', $start);
        $end   = str_replace(' -->', 'REGEX_PLACEHOLDER -->', $end);

        $regex = '(' . RegEx::quote($start) . '|' . RegEx::quote($end) . ')';

        $regex = str_replace('REGEX_PLACEHOLDER', '(:? [a-z0-9]*)?', $regex);

        $string = RegEx::replace(
            $regex,
            '',
            $string
        );

        [$start, $end] = self::getMessageCommentTags($name);

        $string = RegEx::replace(
            RegEx::quote($start) . '.*?' . RegEx::quote($end),
            '',
            $string
        );
    }

    /**
     * Remove tags from tag attributes
     */
    public static function removeFromHtmlTagAttributes(
        string &$string,
        array  $tags,
        string $attributes = 'ALL',
        bool   $include_closing_tags = true
    ): void
    {
        [$tags, $protected] = self::prepareTags($tags, $include_closing_tags);

        if ($attributes == 'ALL')
        {
            $attributes = ['[a-z][a-z0-9-_]*'];
        }

        if ( ! is_array($attributes))
        {
            $attributes = [$attributes];
        }

        RegEx::matchAll(
            '\s(?:' . implode('|', $attributes) . ')\s*=\s*".*?"',
            $string,
            $matches,
            null,
            PREG_PATTERN_ORDER
        );

        if (empty($matches) || empty($matches[0]))
        {
            return;
        }

        $matches = array_unique($matches[0]);

        // preg_quote all tags
        $tags_regex = RegEx::quote($tags) . '.*?\}';

        foreach ($matches as $match)
        {
            if ( ! StringHelper::contains($match, $tags))
            {
                continue;
            }

            $title = $match;

            $title = RegEx::replace($tags_regex, '', $title);

            $string = StringHelper::replaceOnce($match, $title, $string);
        }
    }

    /**
     * Remove tags from title tags
     */
    public static function removeFromHtmlTagContent(
        string &$string,
        array  $tags,
        bool   $include_closing_tags = true,
        array  $html_tags = ['title']
    ): void
    {
        [$tags, $protected] = self::prepareTags($tags, $include_closing_tags);

        if ( ! is_array($html_tags))
        {
            $html_tags = [$html_tags];
        }

        RegEx::matchAll('(<(' . implode('|', $html_tags) . ')(?:\s[^>]*?)>)(.*?)(</\2>)', $string, $matches);

        if (empty($matches))
        {
            return;
        }

        foreach ($matches as $match)
        {
            $content = $match[3];

            foreach ($tags as $tag)
            {
                $content = RegEx::replace(RegEx::quote($tag) . '.*?\}', '', $content);
            }

            $string = str_replace($match[0], $match[1] . $content . $match[4], $string);
        }
    }

    /**
     * Remove inline comments in scrips and styles
     */
    public static function removeInlineComments(string &$string, string $name): void
    {
        [$start, $end] = Protect::getInlineCommentTags($name, '', true);
        $string = RegEx::replace('(' . $start . '|' . $end . ')', "\n", $string);
    }

    /**
     * Remove leftover plugin tags
     */
    public static function removePluginTags(
        string &$string,
        array  $tags,
        string $character_start = '{',
        string $character_end = '}',
        bool   $keep_content = true
    ): void
    {
        $regex_character_start = RegEx::quote($character_start);
        $regex_character_end   = RegEx::quote($character_end);

        foreach ($tags as $tag)
        {
            if ( ! is_array($tag))
            {
                $tag = [$tag, $tag];
            }

            if (count($tag) < 2)
            {
                $tag = [$tag[0], $tag[0]];
            }

            if ( ! StringHelper::contains($string, $character_start . '/' . $tag[1] . $character_end))
            {
                continue;
            }

            $regex = $regex_character_start . RegEx::quote($tag[0]) . '(?:\s.*?)?' . $regex_character_end
                . '(.*?)'
                . $regex_character_start . '/' . RegEx::quote($tag[1]) . $regex_character_end;

            $replace = $keep_content ? '\1' : '';

            $string = RegEx::replace($regex, $replace, $string);
        }
    }

    /**
     * Replace any protected text to original
     */
    public static function unprotect(string|array &$string): void
    {
        if (is_array($string))
        {
            foreach ($string as &$part)
            {
                self::unprotect($part);
            }

            return;
        }

        self::unprotectByDelimiters(
            $string,
            [self::$protect_tags_start, self::$protect_tags_end]
        );

        self::unprotectByDelimiters(
            $string,
            [self::$protect_start, self::$protect_end]
        );

        if (StringHelper::contains($string, [self::$protect_tags_start, self::$protect_tags_end, self::$protect_start, self::$protect_end]))
        {
            self::unprotect($string);
        }
    }

    /**
     * Replace any protected text to original
     */
    public static function unprotectHtmlSafe(string &$string): void
    {
        $string = str_replace(
            [
                self::$html_safe_start,
                self::$html_safe_end,
                self::$html_safe_tags_start,
                self::$html_safe_tags_end,
            ],
            [
                self::$protect_start,
                self::$protect_end,
                self::$protect_tags_start,
                self::$protect_tags_end,
            ],
            $string
        );

        self::unprotect($string);
    }

    /**
     * Replace any protected tags to original
     */
    public static function unprotectTags(
        string &$string,
        array  $tags = [],
        bool   $include_closing_tags = true
    ): void
    {
        [$tags, $protected] = self::prepareTags($tags, $include_closing_tags);

        $string = str_replace($protected, $tags, $string);
    }

    /**
     * Wraps a style or javascript declaration with comment tags
     */
    public static function wrapDeclaration(
        string $content = '',
        string $name = '',
        string $type = 'styles',
        bool   $minify = true
    ): string
    {
        if (empty($name))
        {
            return $content;
        }

        [$start, $end] = self::getInlineCommentTags($name, $type);

        $spacer = $minify ? ' ' : "\n";

        return $start . $spacer . $content . $spacer . $end;
    }

    /**
     * Wrap string in comment tags
     */
    public static function wrapInCommentTags(string $name, string $string): string
    {
        [$start, $end] = self::getCommentTags($name);

        return $start . $string . $end;
    }

    /**
     * Wraps a javascript declaration with comment tags
     */
    public static function wrapScriptDeclaration(
        string $content = '',
        string $name = '',
        bool   $minify = true
    ): string
    {
        return self::wrapDeclaration($content, $name, 'scripts', $minify);
    }

    /**
     * Wraps a stylesheet declaration with comment tags
     */
    public static function wrapStyleDeclaration(
        string $content = '',
        string $name = '',
        bool   $minify = true
    ): string
    {
        return self::wrapDeclaration($content, $name, 'styles', $minify);
    }

    /**
     * Check if the string contains certain substrings to protect
     */
    private static function containsStringsToProtect(
        string $string,
        array  $search_strings = []
    ): bool
    {
        if (
            empty($string)
            || (
                ! str_contains($string, '<input')
                && ! str_contains($string, '<textarea')
                && ! str_contains($string, '<select')
            )
        )
        {
            return false;
        }

        // No specified strings tags found in the string
        if ( ! empty($search_strings) && ! StringHelper::contains($string, $search_strings))
        {
            return false;
        }

        return true;
    }

    /**
     * Prepare the tags and protected tags array
     */
    private static function prepareTags(array|string $tags, $include_closing_tags = true): array
    {
        if ( ! is_array($tags))
        {
            $tags = [$tags];
        }

        $cache = new Cache;

        if ($cache->exists())
        {
            return $cache->get();
        }

        foreach ($tags as $i => $tag)
        {
            if (StringHelper::is_alphanumeric($tag[0]))
            {
                $tag = '{' . $tag;
            }

            $tags[$i] = $tag;

            if ($include_closing_tags)
            {
                $tags[] = RegEx::replace('^([^a-z0-9]+)', '\1/', $tag);
            }
        }

        return $cache->set([$tags, self::protectArray($tags, true)]);
    }

    /**
     * Encode array of strings
     */
    private static function protectArray(array $array, bool $is_tag = false): array
    {
        foreach ($array as &$string)
        {
            $string = self::protectString($string, $is_tag);
        }

        return $array;
    }

    /**
     * Protect the input fields in the string
     */
    private static function protectFieldsInputFields(string &$string): void
    {
        if ( ! str_contains($string, '<input'))
        {
            return;
        }

        $type_values = '(?:text|email|hidden)';
        // must be of certain type
        $param_type = '\s+type\s*=\s*(?:"' . $type_values . '"|\'' . $type_values . '\'])';
        // must have a non-empty value or placeholder attribute
        $param_value = '\s+(?:value|placeholder)\s*=\s*(?:"[^"]+"|\'[^\']+\'])';
        // Regex to match any other parameter
        $params = '(?:\s+[a-z][a-z0-9-_]*(?:\s*=\s*(?:"[^"]*"|\'[^\']*\'|[0-9]+))?)*';

        self::protectByRegex(
            $string,
            '(?:(?:'
            . '<input' . $params . $param_type . $params . $param_value . $params . '\s*/?>'
            . '|<input' . $params . $param_value . $params . $param_type . $params . '\s*/?>'
            . ')\s*)+'
        );
    }

    /**
     * Protect the fields in the string
     */
    private static function protectFieldsPart(string &$string): void
    {
        self::protectFieldsTextAreas($string);
        self::protectFieldsInputFields($string);
    }

    /**
     * Protect the textarea fields in the string
     */
    private static function protectFieldsTextAreas(string &$string): void
    {
        if ( ! str_contains($string, '<textarea'))
        {
            return;
        }

        // Only replace non-empty textareas
        // Todo: maybe also prevent empty textareas but with a non-empty placeholder attribute

        // Temporarily replace empty textareas
        $temp_tag = '___TEMP_TEXTAREA___';
        $string   = RegEx::replace(
            '<textarea((?:\s[^>]*)?)>(\s*)</textarea>',
            '<' . $temp_tag . '\1>\2</' . $temp_tag . '>',
            $string
        );

        self::protectByRegex(
            $string,
            '(?:'
            . '<textarea.*?</textarea>'
            . '\s*)+'
        );

        // Replace back the temporarily replaced empty textareas
        $string = str_replace($temp_tag, 'textarea', $string);
    }

    /**
     * Protect part of the AdminForm
     */
    private static function protectFormPart(
        string &$string,
        array  $tags = [],
        array  $protected_tags = []
    ): void
    {
        if ( ! str_contains($string, '</form>'))
        {
            return;
        }

        // Protect entire form
        if (empty($tags))
        {
            $form_parts    = explode('</form>', $string, 2);
            $form_parts[0] = self::protectString($form_parts[0] . '</form>');
            $string        = implode('', $form_parts);

            return;
        }

        $regex_tags = RegEx::quote($tags);

        if ( ! RegEx::match($regex_tags, $string))
        {
            return;
        }

        $form_parts = explode('</form>', $string, 2);
        // protect tags only inside form fields
        RegEx::matchAll(
            '(?:<textarea[^>]*>.*?<\/textarea>|<input[^>]*>)',
            $form_parts[0],
            $matches,
            null,
            PREG_PATTERN_ORDER
        );

        if (empty($matches))
        {
            return;
        }

        $matches = array_unique($matches[0]);

        foreach ($matches as $match)
        {
            $field         = str_replace($tags, $protected_tags, $match);
            $form_parts[0] = str_replace($match, $field, $form_parts[0]);
        }

        $string = implode('</form>', $form_parts);
    }

    private static function unprotectByDelimiters(string &$string, array $delimiters): void
    {
        if ( ! StringHelper::contains($string, $delimiters))
        {
            return;
        }

        $regex = RegEx::preparePattern(RegEx::quote($delimiters), 's', $string);

        $parts = preg_split($regex, $string);

        foreach ($parts as $i => &$part)
        {
            if ($i % 2 == 0)
            {
                continue;
            }

            $part = base64_decode($part);
        }

        $string = implode('', $parts);
    }
}
