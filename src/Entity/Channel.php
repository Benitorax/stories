<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChannelRepository")
 */
class Channel
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @Groups("frontend")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("frontend")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("frontend")
     */
    private $hasPassword;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("frontend")
     */
    private $isPublic;

    /**
     * @ORM\Column(type="array")
     * @Groups("frontend")
     */
    private $users = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getHasPassword(): ?bool
    {
        return $this->hasPassword;
    }

    public function setHasPassword(bool $hasPassword): self
    {
        $this->hasPassword = $hasPassword;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getUsers(): ?array
    {
        return $this->users;
    }

    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
