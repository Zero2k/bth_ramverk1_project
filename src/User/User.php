<?php

namespace Vibe\User;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "User";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $username;
    public $email;
    public $password;
    public $created;
    public $updated;
    public $deleted;
    public $active;
    public $admin;



    /**
     * Create the user.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function createUser($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;        
        $this->setPassword($password);
        $this->save();
    }



    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }



    /**
     * Verify the acronym and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $acronym  acronym to check.
     * @param string $password the password to use.
     *
     * @return boolean true if acronym and password matches, else false.
     */
    public function verifyPassword($email, $password)
    {
        $this->find("email", $email);
        return password_verify($password, $this->password);
    }



    /**
     * Check if the user exists in the database.
     *
     * @param string $email  email to check.
     *
     * @return boolean true if email exist, else false.
     */
    public function userExists($email)
    {
        $user = $this->find("email", $email);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
}
