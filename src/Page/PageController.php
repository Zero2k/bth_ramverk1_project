<?php
namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\User\User;
use \Vibe\Gravatar\Gravatar;
use \Vibe\User\HTMLForm\CreateUserHomeForm;

/**
* Routes class.
*/
class PageController implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;

    /**
     * Show home page.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Home";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $user = new User();
        $user->setDb($this->di->get("database"));
        $gravatar   = new Gravatar();
        $content = null;


        if ($session->get("userId")) {
            $user = $user->find("id", $session->get("userId"));
            $content["username"] = ucfirst($user->username);
            $content["email"] = $user->email;
            $content["gravatar"] = $gravatar->url($user->email, 180);
        }

        if (!empty($_POST)) {
            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            $userExists = $user->userExists($email);
            if (!$userExists) {
                $user->createUser($username, $email, $password);
                $this->di->get("response")->redirect("login");
            } elseif (!$username && !$email && !$password) {
                $content["message"] = "All fields is required";
            } else {
                $content["message"] = "User already exists";
            }
        }

        $data = [
            "content" => $content,
            "session" => $session
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
