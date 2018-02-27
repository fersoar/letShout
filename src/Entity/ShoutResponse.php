<?php
namespace App\Entity;

use Symfony\Component\HttpFoundation\JsonResponse;

class ShoutResponse
{
    /**
     * @var string[]
     */
    private $errors;

    /**
     * @var string[]
     */
    private $shouts;

    public static function create()
    {
        return new static();
    }

    private function __construct()
    {
        $this->shouts = array();
        $this->errors = array();
    }

    /**
     * @param string $shout
     *
     * @return string[]
     */
    public function addShout($shout)
    {
        array_push($this->shouts, $shout);
    }

    /**
     * @param string $error
     *
     * @return string[]
     */
    public function addError($error)
    {
        array_push($this->error, $error);
    }

    /**
     * @return JsonResponse
     */
    public function doResponse()
    {
        if (count($this->errors) > 0) {
            return new JsonResponse($this->errors, 400);
        }

        if (count($this->shouts) > 0) {
            return new JsonResponse($this->shouts, 200);
        }

        return new JsonResponse(json_encode(['0' => 'The user has not tweets']), 404);

    }
}