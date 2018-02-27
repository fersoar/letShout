<?php

namespace App\Tests\Entity;

use App\Application\TwitterParserHandler;
use App\Entity\ShoutResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterParserHandlerTest extends TestCase
{
    public function testTwitterParserHandlerError()
    {

        $rawOut = "{\"errors\":[{\"code\":32,\"message\":\"Could not authenticate you.\"}]}";
        $shoutResponse = ShoutResponse::create();
        $parser = TwitterParserHandler::create($rawOut, $shoutResponse);
        $parser->execute();
        $jsonResponse = $shoutResponse->doResponse();
        $expected = new JsonResponse(['errors' => [
            [['code'      => 32, 'message'   => 'Could not authenticate you.']]
        ]], 400);

        $this->assertEquals($expected, $jsonResponse);
    }

    public function testTwitterParserHandlerText()
    {

        $rawOut = "[{\"created_at\":\"Fri Dec 15 20:07:16 +0000 2017\",\"id\":941761595679522816,\"id_str\":\"941761595679522816\",\"text\":\"Was kind of thinking I should make my last social media post as a Facebook employee here. Still considering, input welcome.\",\"truncated\":false,\"entities\":{\"hashtags\":[],\"symbols\":[],\"user_mentions\":[],\"urls\":[]},\"source\":\"\u003ca href='...' \u003eTwitter for iPhone\u003c\/a\u003e\",\"in_reply_to_status_id\":null,\"in_reply_to_status_id_str\":null,\"in_reply_to_user_id\":null,\"in_reply_to_user_id_str\":null,\"in_reply_to_screen_name\":null,\"user\":{\"id\":13174,\"id_str\":\"13174\",\"name\":\"Andrew Anker\",\"screen_name\":\"aa\",\"location\":\"Woodside, California\",\"description\":\"Now mostly retiring. Formerly @Facebook, @Wired and a bunch of others.\",\"url\":\"https:\/\/t.co\/6vQYJNd701\",\"entities\":{\"url\":{\"urls\":[{\"url\":\"https:\/\/t.co\/6vQYJNd701\",\"expanded_url\":\"http:\/\/quid.pro\",\"display_url\":\"quid.pro\",\"indices\":[0,23]}]},\"description\":{\"urls\":[]}},\"protected\":false,\"followers_count\":6825,\"friends_count\":99,\"listed_count\":171,\"created_at\":\"Mon Nov 20 03:57:37 +0000 2006\",\"favourites_count\":609,\"utc_offset\":-28800,\"time_zone\":\"Pacific Time (US & Canada)\",\"geo_enabled\":true,\"verified\":false,\"statuses_count\":1680,\"lang\":\"en\",\"contributors_enabled\":false,\"is_translator\":false,\"is_translation_enabled\":false,\"profile_background_color\":\"000000\",\"profile_background_image_url\":\"http:\/\/pbs.twimg.com\/profile_background_images\/2327028\/072300_Sunset1.JPG\",\"profile_background_image_url_https\":\"https:\/\/pbs.twimg.com\/profile_background_images\/2327028\/072300_Sunset1.JPG\",\"profile_background_tile\":false,\"profile_image_url\":\"http:\/\/pbs.twimg.com\/profile_images\/3229803341\/5c8163267750bae0f4899f8ae67a57f6_normal.jpeg\",\"profile_image_url_https\":\"https:\/\/pbs.twimg.com\/profile_images\/3229803341\/5c8163267750bae0f4899f8ae67a57f6_normal.jpeg\",\"profile_banner_url\":\"https:\/\/pbs.twimg.com\/profile_banners\/13174\/1398556645\",\"profile_link_color\":\"0000FF\",\"profile_sidebar_border_color\":\"FFFFFF\",\"profile_sidebar_fill_color\":\"FA6200\",\"profile_text_color\":\"000000\",\"profile_use_background_image\":true,\"has_extended_profile\":false,\"default_profile\":false,\"default_profile_image\":false,\"following\":false,\"follow_request_sent\":false,\"notifications\":false,\"translator_type\":\"regular\"},\"geo\":null,\"coordinates\":null,\"place\":null,\"contributors\":null,\"is_quote_status\":false,\"retweet_count\":0,\"favorite_count\":6,\"favorited\":false,\"retweeted\":false,\"lang\":\"en\"}]";
        $shoutResponse = ShoutResponse::create();
        $parser = TwitterParserHandler::create($rawOut, $shoutResponse);
        $parser->execute();
        $jsonResponse = $shoutResponse->doResponse();
        $expected = new JsonResponse(['shouts' => [
            [
                'number'    => 0,
                'shout'     => 'WAS KIND OF THINKING I SHOULD MAKE MY LAST SOCIAL MEDIA POST AS A FACEBOOK EMPLOYEE HERE. STILL CONSIDERING, INPUT WELCOME.!'
            ]
        ]], 200);

        $this->assertEquals($expected, $jsonResponse);
    }
}