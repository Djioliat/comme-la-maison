<?php

namespace App\Entity;

use App\Repository\WineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WineRepository::class)
 */
class Wine
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
    private $nameCuvee;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $domaineName;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bio;

    /**
     * @ORM\Column(type="text", nullable=true)
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
     * @ORM\Column(type="string", length=50)
     */
    private $imageDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCuvee(): ?string
    {
        return $this->nameCuvee;
    }

    public function setNameCuvee(string $nameCuvee): self
    {
        $this->nameCuvee = $nameCuvee;

        return $this;
    }

    public function getDomaineName(): ?string
    {
        return $this->domaineName;
    }

    public function setDomaineName(string $domaineName): self
    {
        $this->domaineName = $domaineName;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

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

    public function getBio(): ?bool
    {
        return $this->bio;
    }

    public function setBio(bool $bio): self
    {
        $this->bio = $bio;

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

    public function getImageDescription(): ?string
    {
        return $this->imageDescription;
    }

    public function setImageDescription(string $imageDescription): self
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }
}
