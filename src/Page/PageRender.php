<?php

namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Vibe\Coin\Coin;

/**
 * A default page rendering class.
 */
class PageRender implements PageRenderInterface, InjectionAwareInterface
{
    use InjectionAwareTrait;

    public function init()
    {
        $this->coin = new Coin();
        $this->coin->setDb($this->di->get("database"));
    }
    /**
     * Render a standard web page using a specific layout.
     *
     * @param array   $data   variables to expose to layout view.
     * @param integer $status code to use when delivering the result.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ExitExpression)
     */
    public function renderPage($data, $status = 200)
    {
        $this->init();
        $data["stylesheets"] = ["https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css", "https://use.fontawesome.com/releases/v5.0.13/css/all.css", "css/color.css", "css/offcanvas.css", "css/style.css"];

        $data["javascript"] = ["js/offcanvas.js"];

        $data["coins"] = $this->coin->getTrendingCoins(10);
        
        // Add common header, navbar and footer
        $view = $this->di->get("view");
        // $this->view->add("layout/header", [], "header");
        $view->add("layout/navbar", [], "navbar");
        $view->add("layout/subnavbar", $data, "subnavbar");
        $view->add("layout/footer", $data, "footer");
        // Add layout, render it, add to response and send.
        $view->add("layout/app", $data, "app");
        $body = $view->renderBuffered("app");
        $this->di->get("response")->setBody($body)
                       ->send($status);
        exit;
    }
}
