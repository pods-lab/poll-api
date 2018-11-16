<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollItemRepository")
 */
class PollItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemsPerGroup", mappedBy="pollItemRel", cascade={"persist", "remove"})
     */
    protected $groupsPerItem;

    public function __construct()
    {
        $this->groupsPerItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return ItemsPerGroup[]|ArrayCollection
     */
    public function getGroupsPerItem()
    {
        return $this->groupsPerItem;
    }

    /**
     * @param mixed $groupsPerItem
     * @return PollItem
     */
    public function setGroupsPerItem($groupsPerItem)
    {
        $this->groupsPerItem = $groupsPerItem;
        return $this;
    }
}
