<?php
namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\User\User;
use \Vibe\Post\Post;
use \Vibe\Comment\Comment;
use \Vibe\User\HTMLForm\CreateUserHomeForm;

/**
* Routes class.
*/
class PageController implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;

    public function init()
    {
        $this->user = new User();
        $this->user->setDb($this->di->get("database"));

        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));

        $this->comment = new Comment();
        $this->comment->setDb($this->di->get("database"));

        $this->session = $this->di->get("session");
    }

    /**
     * Show home page.
     *
     * @return void
     */
    public function getIndex()
    {
        $this->init();
        $title      = "Home";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;


        if ($this->session->get("userId")) {
            $content = $this->user->getUserInfo($this->session->get("userId"), 180);
        }

        if (!empty($_POST)) {
            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            $userExists = $this->user->userExists($email);
            if (!$userExists) {
                $this->user->createUser($username, $email, $password);
                $this->di->get("response")->redirect("login");
            } elseif (!$username && !$email && !$password) {
                $content["message"] = "All fields is required";
            } else {
                $content["message"] = "User already exists";
            }
        }

        $data = [
            "content" => $content,
            "session" => $this->session,
            "recentQuestions" => $this->post->getPost($limit = 5, $sort = "published", $order = "DESC"),
            "topQuestions" => $this->post->getPost($limit = 5, $sort = "totalVotes", $order = "DESC"),
            "comment" => $this->comment,
        ];

        $view->add("page/index", $data);
        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Show about page.
     *
     * @return void
     */
    public function getAbout()
    {
        $title      = "About";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "items" => "items",
        ];
        $view->add("page/about", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
