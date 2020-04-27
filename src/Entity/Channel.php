<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChannelRepository")
 */
class Channel implements UserInterface
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
    private $name;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("public")
     */
    private $hasPassword;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("public")
     */
    private $isPublic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     * @Groups("public")
     */
    private $usersMax;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("public")
     */
    private $isFull = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="channel")
     * @Groups("private")
     */
    private $users;

    /**
     * @ORM\Column(type="integer")
     * @Groups("public")
     */
    private $usersCount = 0;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Game", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("private")
     */
    private $game;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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

    public function getUsersMax(): ?int
    {
        return $this->usersMax;
    }

    public function setUsersMax(int $usersMax): self
    {
        $this->usersMax = $usersMax;

        return $this;
    }

    public function getIsFull(): ?bool
    {
        return $this->isFull;
    }

    public function setIsFull(bool $isFull): self
    {
        $this->isFull = $isFull;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $this->increaseCount();
            $user->setChannel($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $this->decreaseCount();
            // set the owning side to null (unless already changed)
            if ($user->getChannel() === $this) {
                $user->setChannel(null);
            }
        }

        return $this;
    }

    public function getUsersCount(): ?int
    {
        return $this->usersCount;
    }

    public function increaseCount(): self
    {
        $this->usersCount++;
        if($this->usersCount < 0) $this->usersCount = 0;
        if($this->usersCount == $this->usersMax) $this->setIsFUll(false);

        return $this;
    }

    public function decreaseCount(): self
    {
        $this->usersCount--;
        if($this->usersCount < 0) $this->usersCount = 0;
        if($this->isFull == true) $this->setIsFUll(false);

        return $this;
    }

    public function getRoles() {}

    public function getSalt() {}

    public function getUsername() {}

    public function eraseCredentials() {}

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
