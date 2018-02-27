<?php

namespace App\Application;

class ShoutCommand
{
    public static function create($name, $count)
    {
        return new static($name, $count);
    }

    //Public because symfony needs load it
    public function __construct($name, $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
