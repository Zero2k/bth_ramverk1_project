<?php

namespace Vibe\Post;

use \Vibe\Coin\Coin;
use \Vibe\DateFormat\DateFormat;
use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Anax\TextFilter\TextFilter;

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
    public $html;
    public $views;
    public $votes;
    public $answers;


    /**
     * Get post / questions related to cryptocurrency
     *
     * @param integer $id.
     *
     * @return array
     */
    public function getCoinPosts($id)
    {
        $sql = 'SELECT * FROM ramverk1_Post WHERE coinId = ? ORDER BY published DESC';
        $questions = $this->findAllSql($sql, [$id]);

        $questions = array_map(function ($question) {
            $question->id = $question->id;
            $question->userId = $question->userId;
            $question->coinId = $question->coinId;
            $question->title = $question->title;
            $question->text = $question->text;
            $question->views = $question->views;
            $question->votes = $question->votes;
            $question->answers = $question->answers;
            $question->published = $this->prettyDate($question->published);
            return $question;
        }, $questions);

        return $questions;
    }


    /**
     * Get all users post / questions
     *
     * @param id $id.
     *
     * @return array
     */
    public function getPostWithUser($id)
    {
        $sql = 'SELECT Post.*, User.username, User.email FROM ramverk1_Post Post 
        LEFT JOIN ramverk1_User User on Post.userId = User.id 
        WHERE Post.id = ?';
        $questions = $this->findAllSql($sql, [$id]);

        $questions = array_map(function ($question) {
            $question->id = $question->id;
            $question->userId = $question->userId;
            $question->coinId = $question->coinId;
            $question->title = $question->title;
            $question->text = $question->text;
            $question->views = $question->views;
            $question->votes = $question->votes;
            $question->answers = $question->answers;
            $question->published = $this->prettyDate($question->published);
            $question->username = $question->username;
            $question->email = $question->email;
            return $question;
        }, $questions);

        return $questions;
    }


    /**
     * Get all posts / questions
     *
     * @param integer $limit.
     * @param integer $offset.
     * @param string $sort.
     * @param string $order.
     *
     * @return array
     */
    public function getPost($limit = 5, $offset = 0, $sort = "published", $order = "DESC")
    {
        $sql = 'SELECT 
            Post.*,
            Coin.name,
            Coin.slug,
            SUM(case when vote >= 0 then 1 end) as upVotes,
            SUM(case when vote < 0 then 1 end) as downVotes,
            COUNT(vote) as totalVotes
        FROM ramverk1_Post Post
        LEFT JOIN ramverk1_Vote Vote ON Vote.postId = Post.id
        LEFT JOIN ramverk1_Coin Coin on Post.coinId = Coin.id
        GROUP BY Post.id
        ORDER BY '.$sort.' '.$order.' LIMIT ? OFFSET ?';
        $questions = $this->findAllSql($sql, [$limit, $offset]);

        $questions = array_map(function ($question) {
            $question->id = $question->id;
            $question->userId = $question->userId;
            $question->coinId = $question->coinId;
            $question->title = $question->title;
            $question->text = $question->text;
            $question->views = $question->views;
            $question->votes = $question->votes;
            $question->answers = $question->answers;
            $question->published = $this->prettyDate($question->published);
            $question->name = $question->name;
            $question->slug = $question->slug;
            if ($question->upVotes == null && $question->downVotes == null && $question->totalVotes == null) {
                $question->upVotes = 0;
            } else {
                $question->upVotes = round($question->upVotes / $question->totalVotes * 100);
            }
            return $question;
        }, $questions);

        return $questions;
    }


    /**
     * return all posts / questions
     *
     * @param string $query.
     *
     * @return array
     */
    public function countPosts($query)
    {
        return $this->findAllSql($query);
    }


    /**
     * Get all posts / questions related to tag
     *
     * @param string $name.
     * @param integer $limit.
     *
     * @return array
     */
    public function getAllPostFromTag($name, $limit = 10)
    {
        $sql = 'SELECT Post.* FROM ramverk1_Post Post
        LEFT JOIN ramverk1_TagQuestion TQ ON TQ.postId = Post.id
        LEFT JOIN ramverk1_Tag Tag ON Tag.id = TQ.tagId
        WHERE Tag.tag = ? 
        ORDER BY published DESC LIMIT ?';
        $questions = $this->findAllSql($sql, [$name, $limit]);

        $questions = array_map(function ($question) {
            $question->id = $question->id;
            $question->userId = $question->userId;
            $question->coinId = $question->coinId;
            $question->title = $question->title;
            $question->text = $question->text;
            $question->views = $question->views;
            $question->votes = $question->votes;
            $question->answers = $question->answers;
            $question->published = $this->prettyDate($question->published);
            return $question;
        }, $questions);

        return $questions;
    }


    /**
     * Get all posts / questions related to user
     *
     * @param id $id.
     * @param integer $limit.
     * @param integer $offset.
     *
     * @return array
     */
    public function getUserPosts($id, $limit = 5, $offset = 0)
    {
        $sql = 'SELECT Post.*, Coin.name, Coin.slug FROM ramverk1_Post Post 
        LEFT JOIN ramverk1_Coin Coin ON Post.coinId = Coin.id 
        WHERE userId = ? 
        ORDER BY published DESC LIMIT ? OFFSET ?';
        return $this->findAllSql($sql, [$id, $limit, $offset]);
    }


    /**
     * Create post / question
     *
     * @param id $userId.
     * @param id $coinId.
     * @param string $title.
     * @param string $text.
     *
     * @return this
     */
    public function createPost($userId, $coinId, $title, $text)
    {
        $this->userId = $userId;
        $this->coinId = $coinId;
        $this->title = strtolower($title);
        $this->text = $text;
        $this->html = $this->parseContent($text);
        $this->views = 0;
        $this->votes = 0;
        $this->answers = 0;
        $this->save();
        return $this;
    }


    /**
     * Update post / question
     *
     * @param id $userId.
     * @param id $coinId.
     * @param string $title.
     * @param string $text.
     *
     */
    public function updatePost($questionId, $userId, $title, $text)
    {
        $this->find("id", $questionId);

        $this->id = $this->id;
        $this->userId = $userId;
        $this->coinId = $this->coinId;
        $this->title = strtolower($title);
        $this->text = $text;
        $this->html = $this->parseContent($text);
        $this->views = $this->views;
        $this->votes = $this->votes;
        $this->answers = $this->answers;
        $this->updated = date("Y-m-d H:i:s");
        $this->update();
    }


    /**
     * Add view to post / question
     *
     * @param id $id.
     *
     */
    public function addPostView($id)
    {
        $post = $this->find("id", $id);
        if ($post) {
            $this->views = $post->views + 1;
            $this->save();
        }
    }


    /**
     * Check if post / question exists
     *
     * @param string $search.
     * @param string $type.
     *
     * @return boolean
     */
    public function postExists($search, $type)
    {
        switch ($type) {
            case "id":
                $post = $this->find("id", $search);
                break;
            case "title":
                $post = $this->find("title", $search);
                break;
        }
        
        if ($post) {
            return true;
        } else {
            return false;
        }
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
