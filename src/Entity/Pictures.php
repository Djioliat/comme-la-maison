<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PicturesRepository::class)
 */
class Pictures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titlePhoto;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlePhoto(): ?string
    {
        return $this->titlePhoto;
    }

    public function setTitlePhoto(string $titlePhoto): self
    {
        $this->titlePhoto = $titlePhoto;

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
}
