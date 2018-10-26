<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemsPerGroupRepository")
 */
class ItemsPerGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomenclature;

    /**
     * @ORM\Column(type="integer", name="poll_item_fk")
     */
    private $pollItemFk;

    /**
     * @ORM\Column(type="integer", name="group_fk")
     */
    private $groupFk;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="itemsPerGroup")
     * @ORM\JoinColumn(name="group_fk", referencedColumnName="id")
     */
    protected $groupRel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PollItem", inversedBy="groupsPerItem")
     * @ORM\JoinColumn(name="poll_item_fk", referencedColumnName="id")
     */
    protected $pollItemRel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomenclature(): ?string
    {
        return $this->nomenclature;
    }

    public function setNomenclature(?string $nomenclature): self
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getPollItemFk(): ?int
    {
        return $this->pollItemFk;
    }

    public function setPollItemFk(int $pollItemFk): self
    {
        $this->pollItemFk = $pollItemFk;

        return $this;
    }

    public function getGroupFk(): ?int
    {
        return $this->groupFk;
    }

    public function setGroupFk(int $groupFk): self
    {
        $this->groupFk = $groupFk;

        return $this;
    }
}
