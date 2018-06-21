<?php

namespace Vibe\Vote;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Vote extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Vote";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $postId;
    public $commentId;
    public $vote;



    public function likePost($userId, $postId, $value)
    {
        if ($this->userAlreadyVoted($userId, $postId)) {
            $this->userId = $userId;
            $this->postId = $postId;
            $this->commentId = null;
            $this->vote = $value;
            $this->save();
        }
    }



    public function userAlreadyVoted($userId, $postId)
    {
        $sql = 'SELECT * FROM ramverk1_Vote WHERE userId = ? AND postId = ?;';
        $post = $this->findAllSql($sql, [$userId, $postId]);

        if (!$post) {
            return true;
        } else {
            return false;
        }
    }



    public function getUpvotes($postId)
    {
        $sql = 'SELECT 
                SUM(case when vote >= 0 then 1 end) as upVotes,
                SUM(case when vote < 0 then 1 end) as downVotes,
                COUNT(vote) as totalVotes
                FROM ramverk1_Vote where postId = ?';
        $upvotes = $this->findAllSql($sql, [$postId]);

        if ($upvotes[0]->upVotes == null && $upvotes[0]->downVotes == null && $upvotes[0]->totalVotes == null) {
            return 0;
        } else {
            return round($upvotes[0]->upVotes / $upvotes[0]->totalVotes * 100);
        }
    }
}
