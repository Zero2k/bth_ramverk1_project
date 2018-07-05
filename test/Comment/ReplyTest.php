<?php

namespace Vibe\Comment;

/**
 * Unit test for Reply class
 */
class ReplyTest extends \PHPUnit_Framework_TestCase
{
    protected $di;
    protected $reply;

    public function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("diTest.php");
        $this->reply = new Reply();
        $this->reply->setDb($this->di->get("database"));
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
        $this->assertInstanceOf("\Vibe\Comment\Reply", $this->reply);
    }



    public function testAttributes()
    {
        $this->assertClassHasAttribute("id", "\Vibe\Comment\Reply");
        $this->assertClassHasAttribute("userId", "\Vibe\Comment\Reply");
        $this->assertClassHasAttribute("commentId", "\Vibe\Comment\Reply");
        $this->assertClassHasAttribute("text", "\Vibe\Comment\Reply");
    }



    public function testCreateReply()
    {
        $userId = 1;
        $commentId = 1;
        $text = "test - First reply";

        $res = $this->reply->createReply($userId, $commentId, $text);
        $this->assertEquals($res->userId, 1);
    }
}
