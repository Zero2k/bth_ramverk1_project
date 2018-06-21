<?php

namespace Vibe\Post\HTMLForm;

use \Vibe\Post\Post;
use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Form to update an item.
 */
class PostUpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id, $userId)
    {
        parent::__construct($di);
        $post = $this->getItemDetails($id, $userId);

        /* If questions doesn't belong to user, redirect to all questions */
        if (!$post) {
            $this->di->get("response")->redirect("questions");
        }

        $this->form->create(
            [
                "id" => __CLASS__,
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $post->id,
                ],

                "title" => [
                    "type" => "text",
                    "class" => "form-control",
                    "readonly" => true,
                    "value" => $post->title,
                ],

                "text" => [
                    "type" => "textarea",
                    "class" => "form-control",
                    "validation" => ["not_empty"],
                    "value" => $post->text,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "class" => "btn btn-primary",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Post
     */
    public function getItemDetails($id, $userId)
    {
        $post = new Post();
        $post->setDb($this->di->get("database"));
        $post->find("id", $id);
        if ($post->userId == $userId) {
            return $post;
        }
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $post = new Post();
        $post->setDb($this->di->get("database"));

        $userId = $this->di->get("session")->get("userId");
        $id = $this->form->value("id");
        $title = $this->form->value("title");
        $text = $this->form->value("text");

        // Check if text is empty
        if (!$text) {
            $this->form->rememberValues();
            $this->form->addOutput("You can't submit an empty question.");
            return false;
        }

        $post->updatePost($id, $userId, $title, $text);

        /* $this->di->get("response")->redirect("questions"); */
        $this->form->addOutput("Question was updated.");
        return true;
    }
}
