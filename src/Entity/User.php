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
     * @Groups("public")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("public")
     */
    private $username;

    /**
     * @ORM\Column(type="integer")
     * @Groups("public")
     */
    private $points = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $channel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("play")
     */
    private $token;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("public")
     */
    private $vote = null;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("private")
     */
    private $isStoryteller = false;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("public")
     */
    private $isConnected = true;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("private")
     */
    private $isReady = false;

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

    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    public function setChannel(?Channel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getVote(): ?bool
    {
        return $this->vote;
    }

    public function setVote(?bool $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getIsStoryteller(): ?bool
    {
        return $this->isStoryteller;
    }

    public function setIsStoryteller(bool $isStoryteller): self
    {
        $this->isStoryteller = $isStoryteller;

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

    public function getIsReady(): ?bool
    {
        return $this->isReady;
    }

    public function setIsReady(bool $isReady): self
    {
        $this->isReady = $isReady;

        return $this;
    }
}
