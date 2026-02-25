<?php

/*
 * Copyright (C) 2017 KAINOTOMO PH LTD <info@kainotomo.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Joomla\Component\Sptransfer\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Content as OriginalTable;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Object\CMSObject;
use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Helper\TagsHelper;

class Content extends OriginalTable {
    public function check() {
        $hits = $this->hits;
        try {
            $result = parent::check();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());

            return false;
        }

        if ($result) {
            $this->hits = $hits;
            return true;
        }
        return false;
    }
}

class ArticleModel extends \Joomla\Component\Content\Administrator\Model\ArticleModel
{
    public function getTable($name = '', $prefix = '', $options = array())
    {
        if (empty($options['dbo'])) {
            $options['dbo'] = $this->_db;
        }

        $table = new Content($this->_db);
        $table->set('sp_id', $this->sp_id);
        return $table;
    }

    protected function canDelete($record)
    {
        $record = true;
        return $record;
    }

    public function getItem($pk = null)
    {
        try {
            $item = parent::getItem($pk);
        } catch (\Throwable $exc) {
            $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
            $table = $this->getTable();

            if ($pk > 0) {
                // Attempt to load the row.
                $return = $table->load($pk);

                // Check for a table object error.
                if ($return === false && $table->getError()) {
                    $this->setError($table->getError());

                    return false;
                }
            }

            // Convert to the CMSObject before adding other data.
            $properties = $table->getProperties(1);
            $item = ArrayHelper::toObject($properties, CMSObject::class);

            if (property_exists($item, 'params')) {
                $registry = new Registry($item->params);
                $item->params = $registry->toArray();
            }

            if ($item) {
                // Convert the params field to an array.
                $registry = new Registry($item->attribs);
                $item->attribs = $registry->toArray();

                // Convert the metadata field to an array.
                $registry = new Registry($item->metadata);
                $item->metadata = $registry->toArray();

                // Convert the images field to an array.
                $registry = new Registry($item->images);
                $item->images = $registry->toArray();

                // Convert the urls field to an array.
                $registry = new Registry($item->urls);
                $item->urls = $registry->toArray();

                $item->articletext = trim($item->fulltext) != '' ? $item->introtext . "<hr id=\"system-readmore\">" . $item->fulltext : $item->introtext;

                if (!empty($item->id)) {
                    $item->tags = new TagsHelper;
                    $item->tags->getTagIds($item->id, 'com_content.article');

                    $item->featured_up = null;
                    $item->featured_down = null;
                }
            }

            // Load associated content items
            $assoc = Associations::isEnabled();

            if ($assoc) {
                $item->associations = array();

                if ($item->id != null) {
                    $associations = Associations::getAssociations('com_content', '#__content', 'com_content.item', $item->id);

                    foreach ($associations as $tag => $association) {
                        $item->associations[$tag] = $association->id;
                    }
                }
            }
        }

        return $item;
    }
}

/**
 * Description of Com_contentModel
 *
 * @author KAINOTOMO PH LTD <info@kainotomo.com>
 */
class Com_contentModel extends ComModel
{

    function __construct($config = array())
    {
        parent::__construct($config);
        $jinput = Factory::getApplication()->input;
        if ($jinput->get('task') == 'transfer_all') {
            $this->params->set('new_ids', 2);
        }
        $this->params->set('duplicate_alias', 0);
    }

    public function content($ids = null)
    {

        $this->destination_model = new ArticleModel(array('dbo' => $this->destination_db));
        $this->source_model = new ArticleModel(array('dbo' => $this->source_db));

        $this->task->query = 'SELECT ' . $this->id . ' 
            FROM #__' . $this->task->name . '
            WHERE ' . $this->id . ' > 0';

            $this->ordering = ' ORDER BY ordering ASC, id ASC';
            
        $this->items_copy($ids);
    }

    public function content_fix($ids = null)
    {

        $this->destination_model = new ArticleModel(array('dbo' => $this->destination_db));
        $this->source_model = new ArticleModel(array('dbo' => $this->source_db));

        $this->task->query = 'SELECT ' . $this->id . '
            FROM #__' . $this->task->name . '
            WHERE catid > 0';

        $this->items_fix($ids);
    }
}
