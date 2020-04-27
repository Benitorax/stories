<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * waiting, selecting, playing, rating
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("private")
     */
    private $stage = 'waiting';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("private")
     */
    private $version;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups("private")
     */
    private $messages = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getMessages(): ?array
    {
        return $this->messages;
    }

    public function setMessages(?array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }
}
