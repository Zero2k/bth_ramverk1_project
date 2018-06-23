<?php

namespace Vibe\Comment\HTMLForm;

use \Vibe\Comment\Comment;
use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Example of FormModel implementation.
 */
class CommentCreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $username, $postId)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__
            ],
            [
                "postId" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $postId,
                ],
        
                "text" => [
                    "label" => "Leave a comment as $username",
                    "class" => "form-control",
                    "type"        => "textarea",
                ],
        
                "submit" => [
                    "class" => "btn btn-primary",
                    "type" => "submit",
                    "value" => "Add comment",
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
        $postId = $this->form->value("postId");
        $text = $this->form->value("text");
        $userId = $this->di->get("session")->get("userId");

        $this->form->addOutput("Comment was created.");
        return true;
    }
}