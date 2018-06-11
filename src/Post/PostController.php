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
        $title      = "A index page";
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
        # code...
    }
}
