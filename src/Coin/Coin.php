<?php

namespace Vibe\Coin;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Coin extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Coin";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $name;
    public $slug;
    public $description;



    /**
     * Check if the coin exists in the database.
     *
     * @param string $email  email to check.
     *
     * @return boolean true if email exist, else false.
     */
    public function coinExists($name)
    {
        $coin = $this->find("slug", $name);
        if ($coin) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Get data about cryptocurrency.
     *
     * @param string $name.
     *
     * @return array
     */
    public function getCoinInfo($name)
    {
        return $this->find("slug", $name);
    }


    /**
     * Get all cryptocurrencies with posts.
     *
     * @param integer $limit.
     *
     * @return array
     */
    public function getTrendingCoins($limit = 5)
    {
        $sql = 'SELECT Coin.id, Coin.name, Coin.slug, count(Post.id) as total_posts 
        FROM ramverk1_Coin Coin
        LEFT JOIN ramverk1_Post Post ON Coin.id = Post.coinId 
        GROUP BY Coin.id 
        ORDER BY total_posts DESC 
        LIMIT ?';

        return $this->findAllSql($sql, [$limit]);
    }


    /**
     * Get all cryptocurrencies.
     *
     * @return array
     */
    public function getAllCoins()
    {
        $sql = 'SELECT Coin.id, Coin.description, Coin.name, Coin.slug, count(Post.id) as total_posts 
        FROM ramverk1_Coin Coin 
        LEFT JOIN ramverk1_Post Post ON Coin.id = Post.coinId 
        GROUP BY Coin.id 
        ORDER BY id ASC';

        return $this->findAllSql($sql);
    }
}
