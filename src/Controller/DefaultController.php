<?php

namespace App\Controller;

use App\Entity\ItemsPerGroup;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package App\Controller
 * @@Rest\Route("/v1/test")
 */
class DefaultController extends Controller
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

    /**
     * @Rest\Get("/create-fixtures")
     */
    public function createDataFixtures()
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository("App:Group")->findAll();
        echo "<pre>";
        foreach($groups as $group) {
            $title = str_replace('
', '', $group->getTitle());
            $items = $group->getItemsPerGroup();
            $strItems = $this->getStrItems($items);
            $str = "[\n";
            $str .= "\t\t'title' => '{$title}',\n";
            $str .= "\t\t'description' => '{$group->getDescription()}',\n";
            $str .= "\t\t'items' => [\n";
            $str .= "{$this->getStrItems($items)}";
            $str .= "\t\t],\n";
            $str .= "],\n";

            echo $str;
        }
        exit();
    }

    /**
     * @param $itemsPerGroup ItemsPerGroup[]
     */
    private function getStrItems($itemsPerGroup)
    {
        $str = "";
        $firstLine = true;
        foreach($itemsPerGroup AS $ipg) {
            $item = $ipg->getPollItemRel();
            $str .= "\t\t\t[";
            $str .= "'title' => '{$item->getTitle()}', ";
            $str .= "'description' => '{$item->getDescription()}', ";
            $str .= "'nomenclature' => '{$ipg->getNomenclature()}'";
            $str .= "],\n";
            $firstLine = false;
        }
        return $str;
    }
}