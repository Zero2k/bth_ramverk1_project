<?php

namespace Vibe\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\HTMLForm\UserLoginForm;
use \Vibe\User\HTMLForm\CreateUserForm;
use \Vibe\User\User;
use \Vibe\Post\Post;

/**
 * A controller class.
 */
class UserController implements
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
        $this->user = new User();
        $this->user->setDb($this->di->get("database"));

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
        $title      = "A index page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "content" => "An index page",
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function viewUserProfile($id = null)
    {
        $this->init();
        $title      = "Profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        if (!$id && $this->session->get("userId")) {
            $content = $this->user->getUserInfo($this->session->get("userId"), 180);
            $posts = $this->post->getUserPosts($this->session->get("userId"));
        } elseif (!$id && !$this->session->get("userId")) {
            $this->di->get("response")->redirect("login");
        } else {
            $content = $this->user->getUserInfo($id, 180);
            $posts = $this->post->getUserPosts($id);
        }

        $data = [
            "content" => $content,
            "posts" => $posts,
            "session" => $this->session,
        ];

        $view->add("profile/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function viewUserSettings()
    {
        $this->init();
        $title      = "Settings";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;

        if ($this->session->get("userId")) {
            $content = $this->user->getUserInfo($this->session->get("userId"), 180);
        } else {
            $this->di->get("response")->redirect("login");
        }

        if (!empty($_POST)) {
            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $country = isset($_POST["country"]) ? $_POST["country"] : "";
            $city = isset($_POST["city"]) ? $_POST["city"] : "";
            $description = isset($_POST["description"]) ? $_POST["description"] : "";
            $website = isset($_POST["website"]) ? $_POST["website"] : "";

            $newPassword = isset($_POST["newPassword"]) ? $_POST["newPassword"] : "";
            $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";

            if (!$newPassword) {
                $this->user->password = $this->user->password;
            } else {
                if ($newPassword !== $confirmPassword) {
                    return false;
                }
                $this->user->username = $this->user->username;
                $this->user->email = $this->user->email;
                $this->user->country = $this->user->country;
                $this->user->city = $this->user->city;
                $this->user->description = $this->user->description;
                $this->user->website = $this->user->website;
                $this->user->password = $newPassword;
                $this->user->setPassword($newPassword);
            }

            if ($username && $email && $country && $city && $description && $website) {
                $this->user->username = strtolower($username);
                $this->user->email = strtolower($email);
                $this->user->country = $country;
                $this->user->city = $city;
                $this->user->description = $description;
                $this->user->website = strtolower($website);
            }

            $this->user->save();

            $this->di->get("response")->redirect("profile/settings");
        }

        $data = [
            "content" => $content,
        ];

        $view->add("profile/settings", $data);

        $pageRender->renderPage(["title" => $title]);
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
    public function getPostLogin()
    {
        $title      = "Login";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $redirect = isset($_GET['redirect']) ? 1 : 0;
        $questionId = isset($_GET['questions']) ? $_GET['questions'] : '';
        $form       = new UserLoginForm($this->di, $redirect, $questionId);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("page/login", $data);

        $pageRender->renderPage(["title" => $title]);
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
    public function getPostCreateUser()
    {
        $title      = "Sign Up";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("page/sign-up", $data);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Handler user logout.
     *
     * @return void
     */
    public function logoutUser()
    {
        $this->di->get('session')->destroy();
        $this->di->get("response")->redirect("");
    }
}
