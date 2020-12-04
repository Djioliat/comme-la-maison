<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class)
     */
    private $foods;

    /**
     * @ORM\ManyToMany(targetEntity=Wine::class)
     */
    private $whineId;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $priceRestaurant;

    /**
     * @ORM\Column(type="float")
     */
    private $priceTakeway;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pictureDescription;

    public function __construct()
    {
        $this->foods =  new ArrayCollection();
        $this->whineId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Food[]
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function addFood(Food $food): self
    {
        if (!$this->foods->contains($food)) {
            $this->foods[] = $food;
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        $this->foods->removeElement($food);

        return $this;
    }

    /**
     * @return Collection|Wine[]
     */
    public function getWhineId(): Collection
    {
        return $this->whineId;
    }

    public function addWhineId(Wine $whineId): self
    {
        if (!$this->whineId->contains($whineId)) {
            $this->whineId[] = $whineId;
        }

        return $this;
    }

    public function removeWhineId(Wine $whineId): self
    {
        $this->whineId->removeElement($whineId);

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

    public function getPriceRestaurant(): ?float
    {
        return $this->priceRestaurant;
    }

    public function setPriceRestaurant(float $priceRestaurant): self
    {
        $this->priceRestaurant = $priceRestaurant;

        return $this;
    }

    public function getPriceTakeway(): ?float
    {
        return $this->priceTakeway;
    }

    public function setPriceTakeway(float $priceTakeway): self
    {
        $this->priceTakeway = $priceTakeway;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPictureDescription(): ?string
    {
        return $this->pictureDescription;
    }

    public function setPictureDescription(string $pictureDescription): self
    {
        $this->pictureDescription = $pictureDescription;

        return $this;
    }
}
