<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

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