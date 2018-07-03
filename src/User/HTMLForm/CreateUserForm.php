<?php

namespace Vibe\User\HTMLForm;

use \Vibe\User\User;
use \Vibe\Karma\Karma;
use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__
            ],
            [
                "username" => [
                    "class" => "form-control",
                    "type"        => "text",
                    "placeholder" => "J. Doe",
                ],

                "email" => [
                    "class" => "form-control",
                    "type"        => "text",
                    "placeholder" => "you@example.com",
                ],
        
                "password" => [
                    "class" => "form-control",
                    "type"        => "password",
                    "placeholder" => "*******",
                ],
        
                "submit" => [
                    "class" => "btn btn-primary btn-block",
                    "type" => "submit",
                    "value" => "Sign up",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $username       = $this->form->value("username");
        $email = $this->form->value("email");
        $password      = $this->form->value("password");

        // Check password matches
        if (!$password) {
            $this->form->rememberValues();
            $this->form->addOutput("You need to enter a password.");
            return false;
        }

        // Create the user and save it to the database
        $user = new User();
        $user->setDb($this->di->get("database"));

        if (!$user->userExists($email)) {
            $user->createUser($username, $email, $password);

            $karma = new Karma();
            $karma->setDb($this->di->get("database"));
            $karma->setKarma($user->id, 5);
        } else {
            $this->form->rememberValues();
            $this->form->addOutput("Username or Email already exists");
            return false;
        }

        $this->form->addOutput("User was created.");
        return true;
    }
}
