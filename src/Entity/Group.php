<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="title", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", name="description", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", name="poll_fk")
     */
    private $pollFk;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Poll", inversedBy="groupsRel")
     * @ORM\JoinColumn(name="poll_fk", referencedColumnName="id")
     */
    protected $pollRel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemsPerGroup", mappedBy="groupRel", cascade={"persist", "remove"})
     */
    protected $itemsPerGroup;

    public function __construct()
    {
        $this->itemsPerGroup = new ArrayCollection();
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

    public function getPollFk(): ?int
    {
        return $this->pollFk;
    }

    public function setPollFk(int $pollFk): self
    {
        $this->pollFk = $pollFk;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPollRel()
    {
        return $this->pollRel;
    }

    /**
     * @param mixed $pollRel
     * @return Group
     */
    public function setPollRel($pollRel)
    {
        $this->pollRel = $pollRel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPerGroup()
    {
        return $this->itemsPerGroup;
    }

    /**
     * @param mixed $itemsPerGroup
     * @return Group
     */
    public function setItemsPerGroup($itemsPerGroup)
    {
        $this->itemsPerGroup = $itemsPerGroup;
        return $this;
    }


}
