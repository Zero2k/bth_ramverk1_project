<?php

namespace Vibe\Coin;

use \Vibe\Coin\Coin;
use \Vibe\Post\Post;
use \Vibe\Vote\Vote;
use \Vibe\Comment\Comment;
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

        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));

        $this->comment = new Comment();
        $this->comment->setDb($this->di->get("database"));

        $this->vote = new Vote();
        $this->vote->setDb($this->di->get("database"));
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
            "coins" => $this->coin->getAllCoins(),
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
    public function getSingleCoin($name = null)
    {
        $this->init();
        $title      = "View single coin";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;

        if (!$this->coin->coinExists($name)) {
            $this->di->get("response")->redirect("coin");
        } else {
            $coin = $this->coin->getCoinInfo($name);
            $content["coin"] = $coin;
            $content["posts"] = $this->post->getCoinPosts($coin["id"]);
        }

        $data = [
            "content" => $content,
            "upvotes" => $this->vote,
            "comment" => $this->comment,
        ];

        $view->add("coin/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
