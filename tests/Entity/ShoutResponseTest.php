<?php

namespace App\Tests\Entity;

use App\Entity\ShoutResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShoutResponseTest extends TestCase
{
    public function testShoutResponseErrorWithShouts()
    {
        $shoutResponse  = ShoutResponse::create();
        $error          = ['404' => 'Not found'];
        $shout          = ['1' => 'HELLO!'];
        $shoutResponse  ->addShout($shout);
        $shoutResponse  ->addError($error);
        $jsonResponse   = $shoutResponse->doResponse();
        $errors         = ['errors' => [$error]];
        $shouts         = ['shouts' => [$shout]];
        $shouldBe       = new JsonResponse($errors, 400);
        $notShouldBe    = new JsonResponse($shouts, 200);

        $this->assertEquals($shouldBe, $jsonResponse);
        $this->assertNotEquals($notShouldBe, $jsonResponse);
    }

    public function testShoutResponse3Shouts()
    {
        $shoutResponse = ShoutResponse::create();

        $shout1         = ['1' => 'HELLO!'];
        $shout2         = ['2' => 'HELLO2!'];
        $shout3         = ['3' => 'HELLO3!'];
        $shoutResponse  ->addShout($shout1);
        $shoutResponse  ->addShout($shout2);
        $shoutResponse  ->addShout($shout3);
        $jsonResponse   = $shoutResponse->doResponse();
        $shouts         = ['shouts' => [$shout1, $shout2, $shout3]];
        $shouldBe = new JsonResponse($shouts, 200);

        $this->assertEquals($shouldBe, $jsonResponse);
    }

    public function testShoutResponseSingleErrorNoTweets()
    {
        $shoutResponse  = ShoutResponse::create();
        $error          = ['0' => 'The user has not tweets'];
        $jsonResponse   = $shoutResponse->doResponse();
        $shouldBe       = new JsonResponse(['error' => $error], 404);

        $this->assertEquals($shouldBe, $jsonResponse);
    }

}