<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\ItemsPerGroup;
use App\Entity\Poll;
use App\Entity\PollItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $polls = [
        'title' => '',
    ];

    public function load(ObjectManager $manager)
    {
        $dataPath = realpath(__DIR__ . '/../../data/poll_items.php');
        if(!$dataPath) return false;
        $data = include $dataPath;
        $firstPoll = $data[0];
        $poll = $manager->getRepository("App:Poll")->find(1);

        if(!$poll) {
            $poll = (new Poll())
                ->setTitle($firstPoll['title'])
                ->setDate(new \DateTime("now"));
            $manager->persist($poll);
        }

        foreach($firstPoll['groups'] as $group) {
            $newGroup = (new Group())
                ->setTitle($group['title'])
                ->setDescription($group['description'])
                ->setPollRel($poll);
            $manager->persist($newGroup);
            $items = $group['items'];
            foreach($items as $item) {
                $pollItem = (new PollItem())
                    ->setTitle($item['title'])
                    ->setDescription($item['description']);
                $manager->persist($pollItem);
                $itemPerGroup = (new ItemsPerGroup())
                    ->setGroupRel($newGroup)
                    ->setPollItemRel($pollItem)
                    ->setNomenclature($item['nomenclature']);
                $manager->persist($itemPerGroup);
            }
        }
        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
