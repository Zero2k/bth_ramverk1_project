<?php

namespace Vibe\Tag;

use \Vibe\Tag\Tag;
use \Vibe\Tag\TagQuestion;
use \Vibe\Post\Post;
use \Vibe\Comment\Comment;
use \Vibe\Vote\Vote;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class TagController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    public function init()
    {
        $this->tag = new Tag();
        $this->tag->setDb($this->di->get("database"));

        $this->tagQuestion = new TagQuestion();
        $this->tagQuestion->setDb($this->di->get("database"));

        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));

        $this->comment = new Comment();
        $this->comment->setDb($this->di->get("database"));

        $this->vote = new Vote();
        $this->vote->setDb($this->di->get("database"));
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $this->init();
        $title      = "All Tags";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "content" => "An index page",
            "tags" => $this->tag->getAllTags()
        ];

        $view->add("tag/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getSingleTag($name)
    {
        $this->init();
        $title      = "All Posts Related to Tag";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $tagName = strtolower($name);

        if ($this->tag->tagExists($tagName)) {
            $tags = $this->post->getAllPostFromTag($tagName);
        } else {
            $this->di->get("response")->redirect("tags");
        }

        $data = [
            "tagName" => ucfirst($tagName),
            "tags" => $tags,
            "upvotes" => $this->vote,
            "comment" => $this->comment,
        ];

        $view->add("tag/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
