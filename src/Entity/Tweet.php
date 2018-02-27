<?php
namespace App\Entity;

class Tweet
{
    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $text;

    public static function create($number, $text)
    {
        return new static($number, $text);
    }

    private function __construct($number, $text)
    {
        $this->number = $number;
        $this->text = $text;
    }

    /**
     * It shout the tweet
     *
     * @return string[]
     */
    public function toShout()
    {
        return ['number' => $this->number, 'shout' => strtoupper($this->text) . '!'];
    }
}