<?php

namespace Vibe\User\HTMLForm;

use \Vibe\User\User;
use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
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
                "email" => [
                    "class" => "form-control",
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    "placeholder" => "Email",
                ],
                        
                "password" => [
                    "class" => "form-control",
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    "placeholder" => "*******",
                ],

                "submit" => [
                    "class" => "btn btn-primary btn-block",
                    "type" => "submit",
                    "value" => "Login",
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
        $email = $this->form->value("email");
        $password = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("database"));
        $res = $user->verifyPassword($email, $password);
    
        if (!$res) {
           $this->form->rememberValues();
           $this->form->addOutput("User or password did not match.");
           return false;
        }
    
        $this->form->addOutput("User " . $user->username . " logged in.");
        return true;
    }
}
