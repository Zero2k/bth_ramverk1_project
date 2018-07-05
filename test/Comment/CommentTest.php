<?php

namespace Vibe\Comment;

/**
 * Unit test for Comment class
 */
class CommentTest extends \PHPUnit_Framework_TestCase
{
    protected $di;
    protected $comment;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->comment = new Comment();
        $this->comment->setDb($this->di->get("database"));
    }



    public function testDi()
    {
        $this->assertTrue(is_object($this->di));
    }



    public function testDatabaseConnection()
    {
        $database = $this->di->get("database");
        $this->assertTrue(is_object($database));
    }



    public function testInstanceOfComment()
    {
        $this->assertInstanceOf("\Vibe\Comment\Comment", $this->comment);
    }



    public function testAttributes()
    {
        $this->assertClassHasAttribute("id", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("text", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("userId", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("postId", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("votes", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("published", "\Vibe\Comment\Comment");
        $this->assertClassHasAttribute("created", "\Vibe\Comment\Comment");
    }



    public function testCreateComment()
    {
        $userId = 1;
        $postId = 1;
        $text = "test - First comment";
        $textRes = "<p>test - First comment</p>\n";

        $res = $this->comment->createComment($userId, $postId, $text);
        $this->assertEquals($res->id, 3);
        $this->assertEquals($res->userId, $userId);
        $this->assertEquals($res->postId, $postId);
        $this->assertEquals($res->text, $textRes);
    }

    public function testGetCommentPost()
    {
        $postId = 1;

        $res = $this->comment->getCommentPost(1);
        $this->assertEquals(count($res), 3);
        $this->assertEquals($res[0]->userId, 1);
        $this->assertEquals($res[0]->postId, 1);
        $this->assertEquals($res[0]->text, "<p>First comment in Learn how to trade Bitcoin</p>");
    }



    public function testGetCommentCount()
    {
        $postId = 1;

        $res = $this->comment->getCommentCount($postId);
        $this->assertEquals($res, 3);
    }



    public function testAcceptComment()
    {
        $postId = 1;
        $commentId = 1;

        $res1 = $this->comment->acceptComment($postId, $commentId);
        $this->assertEquals($res1->accepted, 1);

        $res2 = $this->comment->acceptComment($postId, $commentId);
        $this->assertEquals($res2->accepted, 0);
    }



    public function testGetRecentCommentsFromUser()
    {
        $userId = 1;

        $res = $this->comment->getRecentCommentsFromUser($userId);
        $this->assertEquals(count($res), 3);
    }
}
