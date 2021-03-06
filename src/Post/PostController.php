<?php

namespace Vibe\Post;

use \Vibe\Post\Post;
use \Vibe\Vote\Vote;
use \Vibe\Karma\Karma;
use \Vibe\Comment\Reply;
use \Vibe\Comment\Comment;
use \Vibe\Gravatar\Gravatar;
use \Vibe\Pagination\Pagination;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\Post\HTMLForm\PostCreateForm;
use \Vibe\Post\HTMLForm\PostUpdateForm;
use \Vibe\Comment\HTMLForm\CommentCreateForm;

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
        
        $this->vote = new Vote();
        $this->vote->setDb($this->di->get("database"));

        $this->comment = new Comment();
        $this->comment->setDb($this->di->get("database"));

        $this->reply = new Reply();
        $this->reply->setDb($this->di->get("database"));

        $this->karma = new Karma();
        $this->karma->setDb($this->di->get("database"));

        $this->gravatar = new Gravatar();
        $this->pagination = new Pagination();

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
        $this->init();
        $title      = "All Questions";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $di         = $this->di;

        $query = "SELECT * FROM ramverk1_Post";
        $limit = 5;
        $totalPosts = count($this->post->countPosts($query));
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $offset = ($currentPage - 1) * $limit;

        $questions  = $this->post->getPost($limit, $offset);

        $pagination = $this->pagination->renderPagination($totalPosts, $offset, $limit, $currentPage, $di);

        $data = [
            "questions" => $questions,
            "comment" => $this->comment,
            "pagination" => $pagination,
        ];

        $view->add("question/view", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getSinglePost($id = null)
    {
        $this->init();
        $title      = "View Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        if ($this->post->postExists($id, "id")) {
            /* ADD VIEW TO POST */
            if ($id && $this->session->get("userId")) {
                $this->post->addPostView($id);
            }
            /* ADD VIEW TO POST */
            $posts = $this->post->getPostWithUser($id);
            $upvotes = $this->vote->getUpvotes($id);
            $userId = $this->session->get("userId");

            $like = isset($_GET["like"]) ? true : false;
            $dislike = isset($_GET["dislike"]) ? true : false;
            $comment = isset($_GET["comment"]) ? $_GET["comment"] : "";
            $accepted = isset($_GET["accept"]) ? $_GET["accept"] : "";

            $sortBy = isset($_GET["sort"]) ? $_GET["sort"] : 'published';
            $order = isset($_GET["order"]) ? $_GET["order"] : 'DESC';

            if ($like && empty($comment) && $userId) {
                $this->vote->likePost($userId, $id, 1);
                $this->di->get("response")->redirect("questions/$id");
            } elseif ($like && $comment && $userId) {
                $this->vote->likeComment($userId, $comment, 1);
                $this->di->get("response")->redirect("questions/$id");
            }

            if ($dislike && empty($comment) && $userId) {
                $this->vote->likePost($userId, $id, -1);
                $this->di->get("response")->redirect("questions/$id");
            } elseif ($dislike && $comment && $userId) {
                $this->vote->likeComment($userId, $comment, -1);
                $this->di->get("response")->redirect("questions/$id");
            }

            if (!empty($accepted) && $posts[0]->userId == $userId) {
                $accpeted = $this->comment->acceptComment($id, $accepted);
                if ($accepted) {
                    $this->di->get("response")->redirect("questions/$id");
                }
            }

            if (!empty($_POST)) {
                $commentId = isset($_POST["commentId"]) ? $_POST["commentId"] : "";
                $text = isset($_POST["text"]) ? $_POST["text"] : "";

                if ($commentId && $text && $userId) {
                    $reply = $this->reply->createReply($userId, $commentId, $text);
                    $this->karma->increaseKarma($userId, 1);
                    if ($reply) {
                        $this->session->set("flash-$commentId", "Reply was created!");
                        $this->di->get("response")->redirect("questions/$id");
                    }
                } else {
                    $this->session->set("flash-$commentId", "You can't submit empty reply.");
                }
            }

            /* Comment Form */
            $form = new CommentCreateForm($this->di, $this->session->get("username"), $id);
            $form->check();
            $commentForm = $form->getHTML();
        } else {
            $this->di->get("response")->redirect("questions");
        }

        $data = [
            "gravatar" => $this->gravatar,
            "session" => $this->session,
            "post" => $posts[0],
            "upvotes" => $upvotes,
            "commentForm" => $commentForm,
            "comments" => $this->comment->getCommentPost($id, $sortBy, $order),
        ];

        $view->add("question/viewSingle", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function addPost()
    {
        $this->init();
        $title      = "Add Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;
        
        if ($this->session->get("userId")) {
            $form = new PostCreateForm($this->di);
            $form->check();
            $content = $form->getHTML();
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "content" => $content,
        ];

        $view->add("question/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function editPost($id = null)
    {
        $this->init();
        $title      = "Update Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $content = null;

        if ($this->session->get("userId")) {
            $form = new PostUpdateForm($this->di, $id, $this->session->get("userId"));
            $form->check();
            $content = $form->getHTML();
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "content" => $content,
        ];

        $view->add("question/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
