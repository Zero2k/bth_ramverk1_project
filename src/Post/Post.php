<?php

namespace Vibe\Post;

use \Vibe\Coin\Coin;
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
        $sql = 'SELECT Post.*, Coin.name, Coin.slug FROM ramverk1_Post Post LEFT JOIN ramverk1_Coin Coin on Post.coinId = Coin.id ORDER BY published DESC LIMIT ?';
        return $this->findAllSql($sql, [$limit]);
    }



    public function getCoinPosts($id)
    {
        $sql = 'SELECT * FROM ramverk1_Post WHERE coinId = ? ORDER BY published DESC';
        return $this->findAllSql($sql, [$id]);
    }



    public function getPostWithUser($id)
    {
        $sql = 'SELECT Post.*, User.id as userId, User.username, User.email FROM ramverk1_Post Post LEFT JOIN ramverk1_User User on Post.userId = User.id WHERE Post.id = ?';
        return $this->findAllSql($sql, [$id]);
    }



    public function getPostWithComments($id)
    {
        # code...
    }



    public function getUserPosts($id)
    {
        $sql = 'SELECT Post.*, Coin.name, Coin.slug FROM ramverk1_Post Post LEFT JOIN ramverk1_Coin Coin on Post.coinId = Coin.id WHERE userId = ? ORDER BY published DESC LIMIT ?';
        return $this->findAllSql($sql, [$id, $limit = 5]);
    }



    public function createPost($userId, $coinId, $title, $text)
    {
        $this->userId = $userId;
        $this->coinId = $coinId;
        $this->title = ucfirst(strtolower($title));
        $this->text = $text;
        $this->views = 0;
        $this->votes = 0;
        $this->answers = 0;
        $this->save();
    }



    public function addPostView($id)
    {
        $post = $this->find("id", $id);
        if ($post) {
            $this->views = $post->views + 1;
            $this->save();
        }
    }



    public function postExists($id)
    {
        $post = $this->find("id", $id);
        if ($post) {
            return true;
        } else {
            return false;
        }
    }
}
