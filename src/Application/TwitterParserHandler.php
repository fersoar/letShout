<?php

namespace App\Application;

use App\Entity\ShoutResponse;
use App\Entity\Tweet;

class TwitterParserHandler
{
    private $rawResponse;

    /**     *
     * @var \ShoutResponse $response
     */
    private $response;

    public static function create($rawResponse, ShoutResponse $response)
    {
        return new static($rawResponse, $response);
    }
    
    private function __construct($rawResponse, ShoutResponse $response)
    {
        $this->rawResponse = $rawResponse;
        $this->response = $response;
    }
    
    public function execute()
    {
        $jsonOut = json_decode($this->rawResponse);

        foreach ($jsonOut as $i => $item) {
            if (isset($item->text)) {
                $tweet = Tweet::create($i, $item->text);
                $this->response->addShout($tweet->toShout());
            } else {
                $this->response->addShout($item);
            }
        }
    }
}