<?php

namespace App\Tests\Entity;

use App\Entity\Tweet;
use PHPUnit\Framework\TestCase;

class TweetTest extends TestCase
{
    public function testShout()
    {
        $tweet1 = Tweet::create(1, 'Hello');
        $tweet2 = Tweet::create(2, 'HeLlo2!');
        $tweet3 = Tweet::create(3, 'hello');

        $this->assertEquals(['number' => 1, 'shout' => 'HELLO!'], $tweet1->toShout());
        $this->assertEquals(['number' => 2, 'shout' => 'HELLO2!!'], $tweet2->toShout());
        $this->assertEquals(['number' => 3, 'shout' => 'HELLO!'], $tweet3->toShout());

        $this->assertNotEquals(['number' => 1, 'shout' => 'HELLO2!!'], $tweet2->toShout());
        $this->assertNotEquals(['number' => 2, 'shout' => 'HELLO2!'], $tweet3->toShout());
    }
}