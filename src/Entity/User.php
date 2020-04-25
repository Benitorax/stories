<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="integer")
     * @Groups("frontend")
     */
    private $points = 0;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("frontend")
     */
    private $isConnected = true;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $channel;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): string 
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles() {}
    public function getPassword() {}
    public function getSalt() {}
    public function eraseCredentials() {}
    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getIsConnected(): ?bool
    {
        return $this->isConnected;
    }

    public function setIsConnected(bool $isConnected): self
    {
        $this->isConnected = $isConnected;

        return $this;
    }

    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    public function setChannel(?Channel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }
}
