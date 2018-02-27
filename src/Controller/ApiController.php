<?php
namespace App\Controller;

use App\Application\ShoutCommand;
use App\Application\ShoutHandler;
use App\Utils\TwitterAPIExchange;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @Route("/api/tweet-shout/{name}/{count}")
     *
     * @Method("GET")
     * @param string $name
     * @param integer $count
     * @param ShoutHandler $shout
     * @return Response
     */
    public function getDDDTweets($name, $count, ShoutHandler $shout)
    {
        $command = ShoutCommand::create($name, $count); //'Named constructors'
        $response = $shout->execute($command);

        return $response;
    }
}