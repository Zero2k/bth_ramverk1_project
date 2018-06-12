<?php

namespace Vibe\Post;

use \Vibe\Post\Post;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\Post\HTMLForm\PostCreateForm;

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
            "content" => "An index page",
        ];

        $view->add("question/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getSingle($id = null)
    {
        $this->init();
        $title      = "View Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        if ($id && $this->session->get("userId")) {
            $this->post->addPostView($id);
        }

        $data = [
            "content" => "An index page",
        ];

        $view->add("question/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
