<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JewelRepository;
use App\Validator\Constraint\SufficientStockAvailable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=JewelRepository::class)
 * @SufficientStockAvailable()
 */
class Component
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     * @ORM\Column(type="integer")
     */
    private $units = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", cascade={"persist"})
     * @ORM\JoinColumn(name="component_id", referencedColumnName="id", nullable=false)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jewel", inversedBy="components")
     */
    private $jewel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setUnits(int $units): self
    {
        $this->units = $units;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(Material $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getJewel(): Jewel
    {
        return $this->jewel;
    }

    public function setJewel(Jewel $jewel): self
    {
        $this->jewel = $jewel;

        return $this;
    }

    public function __toString(): string
    {
        return $this->material;
    }
}
