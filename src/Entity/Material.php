<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 * @UniqueEntity({"color", "label", "size", "type"})
 */
class Material
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="integer", nullable=true)
     */
    private $size;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $units = 0;

    /**
     * @Assert\NotBlank(allowNull=true)
     * @ORM\Column(type="integer", nullable=true)
     */
    private $threshold;

    /**
     * @ORM\ManyToMany(targetEntity=Supplier::class, inversedBy="materials")
     */
    private $suppliers;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class)
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Stone::class)
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id", nullable=true)
     */
    private $stone;

    /**
     * @ORM\OneToMany(targetEntity=Purchase::class, mappedBy="material", cascade={"persist"})
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id", nullable=true)
     */
    private $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
        $this->suppliers = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return ucfirst($this->type);
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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

    public function getUnits(): ?int
    {
        return $this->units;
    }

    public function setUnits(int $units): self
    {
        $this->units = $units;

        return $this;
    }

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }

    public function setThreshold(int $threshold): self
    {
        $this->threshold = $threshold;

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        $this->purchases->removeElement($purchase);

        return $this;
    }

    /**
     * @return Collection|Supplier[]
     */
    public function getSuppliers(): Collection
    {
        return $this->suppliers;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->suppliers->contains($supplier)) {
            $this->suppliers[] = $supplier;
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        $this->suppliers->removeElement($supplier);

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

    public function getStone(): ?Stone
    {
        return $this->stone;
    }

    public function setStone(?Stone $stone): self
    {
        $this->stone = $stone;

        return $this;
    }

    public function getPrice(): ?float
    {
        $units = 0;
        $price = 0;

        /** @var Purchase $purchase */
        foreach ($this->purchases as $purchase) {
            $units += $purchase->getUnits();
            $price += $purchase->getPrice();
        }

        return ($units > 0) ? $price / $units : .0;
    }

    public function __toString(): string
    {
        return "{$this->getLabel()} - T{$this->size}";
    }
}
