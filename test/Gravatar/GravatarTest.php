<?php

namespace Vibe\Gravatar;

/**
 * Unit test for Gravatar class
 */
class GravatarTest extends \PHPUnit_Framework_TestCase
{
    protected $gravatar;

    public function setUp()
    {
        $this->gravatar = new Gravatar();
    }



    public function testGravatarUrl()
    {
        $response = $this->gravatar->url("test@test.com");
        $this->assertEquals("https://www.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=80", $response);
    }
}
