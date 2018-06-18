<?php

namespace Vibe\Tag;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Tag extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tag";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tag;



    public function getAllTags($limit = 10)
    {
        $sql = 'SELECT Tag.id, Tag.tag, count(TagQ.tagId) as total FROM ramverk1_Tag Tag 
        LEFT JOIN ramverk1_TagQuestion TagQ ON Tag.id = TagQ.tagId 
        GROUP BY Tag.id ASC 
        ORDER BY total DESC 
        LIMIT ?';
        return $this->findAllSql($sql, [$limit]);
    }



    public function tagExists($name)
    {
        $tag = $this->find("tag", $name);
        if ($tag) {
            return true;
        } else {
            return false;
        }
    }
}
