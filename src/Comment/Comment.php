<?php

namespace Vibe\Comment;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Vibe\DateFormat\DateFormat;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $postId;
    public $accepted;
    public $votes;
    public $text;
    public $published;
    public $created;
    public $updated;
    public $deleted;



    public function createComment($userId, $postId, $text)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->text = $this->parseContent($text);
        $this->accepted = 0;
        $this->votes = 0;
        $this->deleted = 0;
        $this->save();
        return $this;
    }



    /* public function getCommentPost($postId, $sort, $order)
    {
        $sql = 'SELECT Comment.*, User.username, User.email FROM ramverk1_Comment Comment 
        LEFT JOIN ramverk1_User User ON Comment.userId = User.id 
        WHERE Comment.postId = ? 
        ORDER BY '.$sort.' '.$order.'';
        $comments = $this->findAllSql($sql, [$postId]);

        $comments = array_map(function ($comment) {
            $comment->id = $comment->id;
            $comment->userId = $comment->userId;
            $comment->postId = $comment->postId;
            $comment->votes = $comment->votes;
            $comment->text = $comment->text;
            $comment->published = $this->prettyDate($comment->published);
            return $comment;
        }, $comments);

        return $comments;
    } */



    public function getCommentPost($postId, $sort, $order)
    {
        $sql = 'SELECT 
        Comment.*, 
            User.username, 
            User.email,
            SUM(case when vote >= 0 then 1 end) as upVotes,
            SUM(case when vote < 0 then 1 end) as downVotes,
            COUNT(vote) as totalVotes
        FROM ramverk1_Comment Comment 
        LEFT JOIN ramverk1_Vote Vote ON Comment.id = Vote.commentId
        LEFT JOIN ramverk1_User User ON Comment.userId = User.id 
        WHERE Comment.postId = ? 
        GROUP BY Comment.id
        ORDER BY '.$sort.' '.$order.'';
        $comments = $this->findAllSql($sql, [$postId]);

        $comments = array_map(function ($comment) {
            $comment->id = $comment->id;
            $comment->userId = $comment->userId;
            $comment->postId = $comment->postId;
            $comment->votes = $comment->votes;
            $comment->text = $comment->text;
            $comment->published = $this->prettyDate($comment->published);
            if ($comment->upVotes == null && $comment->downVotes == null && $comment->totalVotes == null) {
                $comment->upVotes = 0;
            } else {
                $comment->upVotes = round($comment->upVotes / $comment->totalVotes * 100);
            }
            return $comment;
        }, $comments);

        return $comments;
    }



    public function getCommentCount($postId)
    {
        $sql = 'SELECT * FROM ramverk1_Comment Comment WHERE Comment.postId = ?';
        $comments = $this->findAllSql($sql, [$postId]);
        return count($comments);
    }


    public function parseContent($content)
    {
        $textfilter = new TextFilter();
        return $textfilter->parse($content, ["markdown", "clickable"])->text;
    }



    public function prettyDate($date)
    {
        $dateformat = new DateFormat();
        return $dateformat->timeElapsedString($date);
    }
}
