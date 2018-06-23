<?php

namespace Vibe\Comment;

use \Vibe\Comment\Comment;
use \Vibe\Comment\Reply;
use \Vibe\Post\Post;
use \Vibe\Vote\Vote;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;

/**
 * A controller class.
 */
class CommentController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;
}
