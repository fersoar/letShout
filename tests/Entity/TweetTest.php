<?php

namespace App\Tests\Entity;

use App\Entity\Tweet;
use PHPUnit\Framework\TestCase;

class TweetTest extends TestCase
{
    public function testShout()
    {
        $tweet1 = Tweet::create(1, 'Hello');
        $tweet2 = Tweet::create(1, 'HeLlo2!');
        $tweet3 = Tweet::create(1, 'hello');

        $this->assertEquals('HELLO!', $tweet1);
        $this->assertEquals('HELLO2!!', $tweet2);
        $this->assertEquals('HELLO!', $tweet3);

    }
}