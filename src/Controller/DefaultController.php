<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class DefaultController
 * @package App\Controller
 * @Rest\Route("/v1/test")
 */
class DefaultController
{
    /**
     * @Rest\Get("/hello", name="test_hello")
     */
    public function index()
    {
        return [
            'hello world!',
        ];
    }
}