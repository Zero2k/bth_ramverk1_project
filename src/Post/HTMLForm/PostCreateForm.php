<?php

namespace Vibe\Post\HTMLForm;

use \Vibe\Post\Post;
use \Vibe\Coin\Coin;
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
    public function __construct(DIInterface $di, $userId)
    {
        parent::__construct($di);
        $coins = $this->getCoinDetails();

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
                    "options" => $coins,
                    "value"    => "bitcoin",
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



    public function getCoinDetails()
    {
        $coin = new Coin();
        $coin->setDb($this->di->get("database"));
        $coins = ["-1" => "Select a coin..."];
        foreach ($coin->findAll() as $obj) {
            $coins[$obj->id] = "{$obj->name}";
        }
        return $coins;
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

        $userId = $userId;
        $coinId = $this->form->value("coin");
        $title = $this->form->value("title");
        $text = $this->form->value("text");
        // $post->tags = $this->form->value("tags");

        $this->form->rememberValues();
        $post->createPost($userId, $coinId, $title, $text);
        $this->form->addOutput("Post was created.");
        return true;
    }
}
