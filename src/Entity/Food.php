<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=FoodType::class)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Pictures::class, cascade={"persist", "remove"})
     */
    private $pictureId;

    /**
     * @ORM\Column(type="float")
     */
    private $priceRestaurant;

    /**
     * @ORM\Column(type="float", nullable=true)
     */

    private $priceTakeway;

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

    public function getType(): ?FoodType
    {
        return $this->type;
    }

    public function setType(?FoodType $type): self
    {
        $this->type = $type;

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

    public function getPictureId(): ?Pictures
    {
        return $this->pictureId;
    }

    public function setPictureId(?Pictures $pictureId): self
    {
        $this->pictureId = $pictureId;

        return $this;
    }

    public function getPriceRestaurant(): ?int
    {
        return $this->priceRestaurant;
    }

    public function setPriceRestaurant(int $priceRestaurant): self
    {
        $this->priceRestaurant = $priceRestaurant;

        return $this;
    }

    public function getPriceTakeway(): ?float
    {
        return $this->priceTakeway;
    }

    public function setPriceTakeway(?float $priceTakeway): self
    {
        $this->priceTakeway = $priceTakeway;

        return $this;
    }
}
