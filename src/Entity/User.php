<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity("email", message="Starfla c pri")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     *@Assert\Length(
           min="2", max="50",
     *     minMessage= "2 caractères minimum !",
     *     maxMessage = "50 caractères maximum !"
*     )
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @Assert\Email(
     *     message= "L'adresse mail n'est pas valide !"
     *     )
     * @ORM\Column(name="email",type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="password" ,type="text")
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     *@Assert\Length(
    min="6", max="50",
     *     minMessage= "6 caractères minimum !",
     *     maxMessage = "50 caractères maximum !"
     *     )
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
private $roles = ['ROLE_USER'];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
