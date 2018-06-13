<?php

namespace Vibe\Post\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Example of FormModel implementation.
 */
class PostCreateForm extends FormModel
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
                "id" => __CLASS__,
            ],
            [
                "title" => [
                    "type"        => "text",
                    "class"       => "form-control",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "coin" => [
                    "type"        => "select",
                    "class"       => "form-control",
                    "options" => [
                        "bitcoin" => "bitcoin",
                        "ethereum" => "ethereum",
                        "dash" => "dash",
                        "nem" => "nem",
                        "ripple" => "ripple"
                    ],
                    "value"    => "bitcoin",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "text" => [
                    "type"        => "textarea",
                    "class"       => "form-control",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "tags" => [
                    "type"        => "text",
                    "class"       => "form-control",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Post Question",
                    "class" => "btn btn-primary",
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
        $this->form->addOutput(
            "Trying to login as: "
            . $this->form->value("user")
            . "<br>Password is kept a secret..."
            //. $this->form->value("password")
        );

        // Remember values during resubmit, useful when failing (retunr false)
        // and asking the user to resubmit the form.
        $this->form->rememberValues();

        return true;
    }
}
