<?php

namespace App\Application;

use App\Entity\ShoutResponse;
use App\Utils\TwitterAPIExchange;
use Symfony\Component\Config\Definition\Exception\Exception;

class ShoutHandler
{
    private $settings;
    private $url;
    private $requestMethod;

    public function __construct($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret)
    {
        $this->settings = array(
            'oauth_access_token' => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
        );

        //Should be assigned by params
        $this->url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $this->requestMethod = 'GET';
    }

    public function execute(ShoutCommand $tweet) {
        $getField = sprintf('screen_name=%s&count=%d', $tweet->name, $tweet->count);

        try {
            $twitter = new TwitterAPIExchange($this->settings);
            $out = $twitter
                ->setGetfield($getField)
                ->buildOauth($this->url, $this->requestMethod)
                ->performRequest();
        } catch (Exception $e) {
            $out = json_encode(['Exception' => $e->getMessage()]);
        }

        $response = ShoutResponse::create();
        $parser = TwitterParserHandler::create($out, $response);
        $parser->execute();

        return $response->doResponse();
    }
}