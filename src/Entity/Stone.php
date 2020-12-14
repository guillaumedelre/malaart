<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Domain\Chakra;
use App\Domain\CrystalSystem;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StoneRepository::class)
 * @UniqueEntity({"label"})
 */
class Stone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $label;

    /**
     * @Assert\NotBlank()
     * @Assert\Choice(choices=Chakra::ALL)
     * @ORM\Column(type="string", length=255)
     */
    private $chakra;

    /**
     * @Assert\NotBlank()
     * @Assert\Choice(choices=CrystalSystem::ALL)
     * @ORM\Column(type="string", length=255)
     */
    private $crystalSystem;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return ucfirst($this->label);
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getChakra(): ?string
    {
        return ucfirst($this->chakra);
    }

    public function setChakra(string $chakra): self
    {
        $this->chakra = $chakra;

        return $this;
    }

    public function getCrystalSystem(): ?string
    {
        return ucfirst($this->crystalSystem);
    }

    public function setCrystalSystem(string $crystalSystem): self
    {
        $this->crystalSystem = $crystalSystem;

        return $this;
    }

    public function getNature(): ?string
    {
        return ucfirst($this->nature);
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getLabel();
    }
}
