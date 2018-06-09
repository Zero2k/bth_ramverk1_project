<?php

namespace Vibe\Coin;

use \Vibe\Coin\Coin;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class CoinController implements
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
        $this->coin = new Coin();
        $this->coin->setDb($this->di->get("database"));
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
        $title      = "View all coins";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "coins" => $this->coin->findAll(),
            "content" => "An index page",
        ];

        $view->add("coin/view", $data);

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
    public function getSingle($name = null)
    {
        $this->init();
        $title      = "View single coin";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;

        if (!$this->coin->coinExists($name)) {
            $this->di->get("response")->redirect("coin");
        } else {
            $content["coin"] = $this->coin->getCoinInfo($name);
        }

        $data = [
            "content" => $content,
        ];

        $view->add("coin/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
