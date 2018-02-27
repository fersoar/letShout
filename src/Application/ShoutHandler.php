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

    public function __construct($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $url)
    {
        $this->settings = array(
            'oauth_access_token' => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
        );

        $this->url = $url;
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