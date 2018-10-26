<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PollController
 * @package App\Controller
 * @Rest\Route("/v1/group")
 */
class GroupController extends FOSRestController
{

    /**
     * @Rest\Get("/list/{pollId}", name="get_list_of_groups")
     */
    public function getPoll(Request $request, $pollId)
    {
        $groups = $this->getDoctrine()->getRepository("App:Group")->findBy([
            'pollFk' => $pollId?? 0,
        ]);

        if(count($groups) === 0) return false;
        $result = [];
        foreach($groups AS $group) {

        }
        var_dump($groups);
        exit();
//        return [
//            'code' => $poll->getId(),
//            'title' => $poll->getTitle(),
//            'description' => $poll->getDescription(),
//            'date' => $poll->getDate()? $poll->getDate()->format('Y-m-d H:i:s') : null,
//        ];
    }

    
}