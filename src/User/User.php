<?php

namespace Vibe\User;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Vibe\Gravatar\Gravatar;

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
    public $country;
    public $city;
    public $description;
    public $website;
    public $created;
    public $updated;
    public $deleted;
    public $admin = 0;



    /**
     * Create the user.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function createUser($username, $email, $password)
    {
        $this->username = strtolower($username);
        $this->email = strtolower($email);
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



    public function getUserInfo($id, $size)
    {
        $user = $this->find("id", $id);
        $gravatar   = new Gravatar();
        $content = null;

        $content["username"] = ucfirst($user->username);
        $content["email"] = $user->email;
        $content["country"] = $user->country;
        $content["city"] = $user->city;
        $content["description"] = $user->description;
        $content["website"] = $user->website;
        $content["gravatar"] = $gravatar->url($user->email, $size);

        return $content;
    }
}
