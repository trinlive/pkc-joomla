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

class SimpleCategory
{
    public static function save(
        string $table,
        int    $item_id,
        string $category,
        string $id_column = 'id'
    ): void
    {
        $db = DB::get();

        $query = $db->getQuery(true)
            ->select(DB::quoteName($id_column))
            ->from(DB::quoteName('#__' . $table))
            ->where(DB::quoteName($id_column) . ' = ' . $item_id);

        $item_exists = $db->setQuery($query)->loadResult();

        if ($item_exists)
        {
            $query = $db->getQuery(true)
                ->update(DB::quoteName('#__' . $table))
                ->set(DB::quoteName('category') . ' = ' . DB::quote($category))
                ->where(DB::quoteName($id_column) . ' = ' . $item_id);

            $db->setQuery($query)->execute();

            return;
        }

        $query = 'SHOW COLUMNS FROM `#__' . $table . '`';
        $db->setQuery($query);

        $columns = $db->loadColumn();

        $values             = array_fill_keys($columns, '');
        $values[$id_column] = $item_id;
        $values['category'] = $category;

        $query = $db->getQuery(true)
            ->insert(DB::quoteName('#__' . $table))
            ->columns(DB::quoteName($columns))
            ->values(implode(',', DB::quote($values)));

        $db->setQuery($query)->execute();
    }
}
