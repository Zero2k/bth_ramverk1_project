<?php
namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\User\User;
use \Vibe\Gravatar\Gravatar;
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

        $data = [
            "content" => $content,
            "session" => $session,
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
