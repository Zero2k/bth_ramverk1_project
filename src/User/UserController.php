<?php

namespace Vibe\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\HTMLForm\UserLoginForm;
use \Vibe\User\HTMLForm\CreateUserForm;
use \Vibe\User\User;

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
        $title      = "Profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $user = new User();
        $user->setDb($this->di->get("database"));
        $session    = $this->di->get("session");

        if (!$id && $session->get("userId")) {
            $content = $user->getUserInfo($session->get("userId"), 180);
        } elseif (!$id && !$session->get("userId")) {
            $this->di->get("response")->redirect("login");
        } else {
            $content = $user->getUserInfo($id, 180);
        }

        $data = [
            "content" => $content,
            "session" => $session,
        ];

        $view->add("profile/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function viewUserSettings()
    {
        $title      = "Settings";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $user = new User();
        $user->setDb($this->di->get("database"));

        if ($session->get("userId")) {
            $content = $user->getUserInfo($session->get("userId"), 180);
        } else {
            $this->di->get("response")->redirect("login");
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
        $form       = new UserLoginForm($this->di);

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
        $this->di->get("response")->redirect("login");
    }
}
