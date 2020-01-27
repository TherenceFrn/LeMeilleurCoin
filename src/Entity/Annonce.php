<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Zip;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $Author_id;

    public function __construct()
    {
        $this->Author_id = 1;
        $this->DateCreated = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->Zip;
    }

    public function setZip(string $Zip): self
    {
        $this->Zip = $Zip;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->DateCreated;
    }

    public function setDateCreated(\DateTimeInterface $DateCreated): self
    {
        $this->DateCreated = $DateCreated;

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->Author_id;
    }

    public function setAuthorId(int $Author_id): self
    {
        $this->Author_id = $Author_id;

        return $this;
    }
}
