<?php

namespace Vibe\Post;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Post extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Post";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $coinId;
    public $title;
    public $text;
    public $views;
    public $votes;
    public $answers;



    public function getAllPosts($limit = 10)
    {
        $sql = 'SELECT Post.*, Coin.name, Coin.slug FROM ramverk1_Post Post LEFT JOIN ramverk1_Coin Coin on Post.coinId = Coin.id LIMIT ?';
        return $this->findAllSql($sql, [$limit]);
    }



    public function getCoinPosts($id)
    {
        $sql = 'SELECT * FROM ramverk1_Post WHERE coinId = ?';
        return $this->findAllSql($sql, [$id]);
    }



    public function getUserPosts($id)
    {
        # code...
    }



    public function addPostView($id)
    {
        $post = $this->find("id", $id);
        if ($post) {
            $this->views = $post->views + 1;
            $this->save();
        }
    }
}
