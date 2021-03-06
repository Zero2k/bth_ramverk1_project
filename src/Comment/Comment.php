<?php

namespace Vibe\Comment;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Vibe\DateFormat\DateFormat;
use \Anax\TextFilter\TextFilter;
use \Vibe\Comment\Reply;

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


    /**
     * Create comment
     *
     * @param id $userId.
     * @param id $postId.
     * @param string $text.
     *
     * @return array
     */
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


    /**
     * Get comments related to post
     *
     * @param id $postId.
     * @param string $sort.
     * @param string $order.
     *
     * @return array
     */
    public function getCommentPost($postId, $sort = "published", $order = "DESC")
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
            $comment->reply = $this->getReplies($comment->id);
            if ($comment->upVotes == null || 0 && $comment->downVotes == null || 0 && $comment->totalVotes == null || 0) {
                $comment->upVotes = 0;
            } else {
                $comment->upVotes = round($comment->upVotes / $comment->totalVotes * 100);
            }
            return $comment;
        }, $comments);

        return $comments;
    }


    /**
     * Change accepted field in comment
     *
     * @param id $postId.
     * @param id $commentId.
     *
     * @return this
     */
    public function acceptComment($postId, $commentId)
    {
        if ($this->acceptedCommentExists($postId, $commentId)) {
            $this->find("id", $commentId);
            if ($this->accepted == 1) {
                $this->accepted = 0;
            } else {
                $this->accepted = 1;
            }
            $this->save();
        }
        return $this;
    }

    /**
     * Check if comment has been accepted
     *
     * @param id $postId.
     * @param id $commentId.
     *
     * @return boolean
     */
    public function acceptedCommentExists($postId, $commentId)
    {
        $sql = 'SELECT * FROM ramverk1_Comment Comment WHERE Comment.postId = ? AND Comment.accepted = 1';
        $comments = $this->findAllSql($sql, [$postId]);

        if (!$comments || $comments[0]->id == $commentId) {
            return true;
        }
    }


    /**
     * Count number of comments
     *
     * @param id $postId.
     *
     * @return integer
     */
    public function getCommentCount($postId)
    {
        $sql = 'SELECT Comment.id FROM ramverk1_Comment Comment WHERE Comment.postId = ?';
        $comments = $this->findAllSql($sql, [$postId]);
        return count($comments);
    }


    /**
     * Get replies based on commentId
     *
     * @param id $id.
     *
     * @return array
     */
    public function getReplies($id)
    {
        $sql = 'SELECT Reply.*, User.username, User.email FROM ramverk1_Reply Reply 
        LEFT JOIN ramverk1_User User ON Reply.userId = User.id
        WHERE Reply.commentId = ? ORDER BY published DESC';
        $replies = $this->findAllSql($sql, [$id]);

        $replies = array_map(function ($reply) {
            $reply->id = $reply->id;
            $reply->userId = $reply->userId;
            $reply->commentId = $reply->commentId;
            $reply->published = $this->prettyDate($reply->published);
            $reply->username = $reply->username;
            $reply->email = $reply->email;
            return $reply;
        }, $replies);

        return $replies;
    }


    /**
     * Get recent comments from user
     *
     * @param id $id.
     * @param integer $limit.
     *
     * @return array
     */
    public function getRecentCommentsFromUser($id, $limit = 5)
    {
        $sql = 'SELECT Comment.*, Post.title, User.username, User.id as userId FROM ramverk1_Comment Comment
        LEFT JOIN ramverk1_User User ON Comment.userId = User.id
        LEFT JOIN ramverk1_Post Post ON Comment.postId = Post.id
        WHERE User.id = ?
        ORDER BY published DESC
        LIMIT ?';

        return $this->findAllSql($sql, [$id, $limit]);
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
