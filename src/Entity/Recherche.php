<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RechercheRepository")
 */
class Recherche
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
    private $searchedword;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSearchedword(): ?string
    {
        return $this->searchedword;
    }

    public function setSearchedword(string $searchedword): self
    {
        $this->searchedword = $searchedword;

        return $this;
    }
}
