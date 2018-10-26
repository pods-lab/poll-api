<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class PollController
 * @package App\Controller
 * @Rest\Route("/v1/poll")
 */
class PollController extends FOSRestController
{

    /**
     * @Rest\Get("/get", name="get_poll")
     */
    public function getPoll()
    {
        $poll = $this->getDoctrine()->getRepository("App:Poll")->find(1);
        if(!$poll) return false;
        return [
            'code' => $poll->getId(),
            'title' => $poll->getTitle(),
            'description' => $poll->getDescription(),
            'date' => $poll->getDate()? $poll->getDate()->format('Y-m-d H:i:s') : null,
        ];
    }


}