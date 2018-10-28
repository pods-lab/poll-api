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
        $groupsResults = [];
        foreach($groups AS $group) {
            $itemsPerGroup = $group->getItemsPerGroup();
            $groupItems = [];
            foreach($itemsPerGroup AS $itemGroup) {
                $item = $itemGroup->getPollItemRel();
                $groupItems[] = [
                    "code" => $item->getId(),
                    "nomenclature" => $itemGroup->getNomenclature(),
                    "title" => $item->getTitle(),
                    "value" => 0,
                ];
            }
            $groupsResults[] = [
                "code" => $group->getId(),
                "title" => $group->getTitle(),
                "average_value" => 0,
                "items" => $groupItems,
            ];
        }
        return [
            "title" => "",
            "average_value" => 0,
            "groups" => $groupsResults,
        ];
    }
}