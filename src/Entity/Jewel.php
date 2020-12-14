<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JewelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=JewelRepository::class)
 * @UniqueEntity("name")
 */
class Jewel
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
    private $name;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="App\Entity\Component", mappedBy="jewel", cascade={"persist", "remove"})
     */
    private $components;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class)
     */
    private $tags;

    public function __construct()
    {
        $this->components = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return ucfirst($this->name);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Component[]
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->components->contains($component)) {
            $component->setJewel($this);
            $this->components[] = $component;
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        $this->components->removeElement($component);
        $component->setJewel(null);

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getPrice(): ?float
    {
        $totalPrice = .0;

        /** @var Component $component */
        foreach ($this->getComponents() ?? [] as $component) {
            $totalPrice += $component->getMaterial()->getPrice() * $component->getUnits();
        }

        return $totalPrice;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
