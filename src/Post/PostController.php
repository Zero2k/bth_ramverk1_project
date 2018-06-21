<?php

namespace Vibe\Post;

use \Vibe\Post\Post;
use \Vibe\Vote\Vote;
use \Vibe\Gravatar\Gravatar;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\Post\HTMLForm\PostCreateForm;
use \Vibe\Post\HTMLForm\PostUpdateForm;

/**
 * A controller class.
 */
class PostController implements
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
        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));
        
        $this->vote = new Vote();
        $this->vote->setDb($this->di->get("database"));

        $this->gravatar = new Gravatar();
        $this->session = $this->di->get("session");
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
        $title      = "All Questions";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "questions" => $this->post->getAllPosts(),
            "upvotes" => $this->vote,
            "content" => "An index page",
        ];

        $view->add("question/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getSinglePost($id = null)
    {
        $this->init();
        $title      = "View Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        if ($this->post->postExists($id, "id")) {
            /* ADD VIEW TO POST */
                /* if ($id && $this->session->get("userId")) {
                    $this->post->addPostView($id);
                } */
            /* ADD VIEW TO POST */
            $posts = $this->post->getPostWithUser($id);
            $upvotes = $this->vote->getUpvotes($id);

            $like = isset($_GET["like"]) ? true : false;
            $dislike = isset($_GET["dislike"]) ? true : false;

            if ($like && $this->session->get("userId")) {
                $this->vote->likePost($this->session->get("userId"), $id, 1);
            }

            if ($dislike && $this->session->get("userId")) {
                $this->vote->likePost($this->session->get("userId"), $id, -1);
            }
        } else {
            $this->di->get("response")->redirect("questions");
        }

        $data = [
            "gravatar" => $this->gravatar,
            "session" => $this->session,
            "post" => $posts[0],
            "upvotes" => $upvotes,
        ];

        $view->add("question/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function addPost()
    {
        $this->init();
        $title      = "Add Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;
        
        if ($this->session->get("userId")) {
            $form = new PostCreateForm($this->di);
            $form->check();
            $content = $form->getHTML();
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "content" => $content,
        ];

        $view->add("question/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function editPost($id = null)
    {
        $this->init();
        $title      = "Update Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;

        if ($this->session->get("userId")) {
            $form = new PostUpdateForm($this->di, $id, $this->session->get("userId"));
            $form->check();
            $content = $form->getHTML();
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "content" => $content,
        ];

        $view->add("question/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
