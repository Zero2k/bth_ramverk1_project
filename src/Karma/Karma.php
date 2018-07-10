<?php

namespace Vibe\Karma;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Karma extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Karma";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     * @var integer $userId user id.
     * @var integer $karma.
     */
    public $id;
    public $userId;
    public $karma;



    /**
     * Set karma to user
     *
     * @param id $userId.
     * @param integer $karma.
     *
     * @return this
     */
    public function setKarma($userId, $karma)
    {
        $this->userId = $userId;
        $this->karma = $karma;
        $this->save();
        return $this;
    }


    /**
     * Increase karma for user
     *
     * @param id $userId.
     * @param integer $karma.
     *
     * @return this
     */
    public function increaseKarma($userId, $karma)
    {
        $this->find("userId", $userId);
        $this->userId = $userId;
        $this->karma = $this->karma + $karma;
        $this->save();
        return $this;
    }


    /**
     * Decrease karma for user
     *
     * @param id $userId.
     * @param integer $karma.
     *
     * @return this
     */
    public function decreaseKarma($userId, $karma)
    {
        $this->find("userId", $userId);
        $this->userId = $userId;
        $this->karma = $this->karma - $karma;
        $this->save();
        return $this;
    }


    /**
     * Get user karma
     *
     * @param id $userId.
     * @param integer $karma.
     *
     * @return this
     */
    public function getKarma($userId)
    {
        return $this->find("userId", $userId);
    }
}
