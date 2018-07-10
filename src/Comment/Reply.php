<?php

namespace Vibe\Comment;

use \Anax\Database\ActiveRecordModel;
use \Anax\DI\DIInterface;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Reply extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Reply";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $commentId;
    public $text;


    /**
     * Create reply to comment
     *
     * @param id $userId.
     * @param id $commentId.
     * @param string $text.
     *
     * @return this
     */
    public function createReply($userId, $commentId, $text)
    {
        $this->userId = $userId;
        $this->commentId = $commentId;
        $this->text = $this->parseContent($text);
        $this->save();
        return $this;
    }



    public function parseContent($content)
    {
        $textfilter = new TextFilter();
        return $textfilter->parse($content, ["markdown", "clickable"])->text;
    }
}
