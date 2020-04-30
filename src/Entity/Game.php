<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    const STAGE_WAITING = 'waiting';
    const STAGE_SELECTING = 'selecting';
    const STAGE_PROPOSING_SUBJECT = 'proposing subject';
    const STAGE_PLAYING = 'playing';
    const STAGE_RATING = 'rating';

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
    private $stage = self::STAGE_WAITING;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("private")
     */
    private $version;

    /**
     * @ORM\Column(type="array")
     * @Groups("private")
     */
    private $messages = [];

    /**
     * @ORM\Column(type="integer")
     * @Groups("private")
     */
    private $rolledDiceCount = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("private")
     */
    private $rolledWhiteDiceCount = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("private")
     */
    private $rolledBlackDiceCount = 0;

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

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function setMessages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function getRolledDiceCount(): ?int
    {
        return $this->rolledDiceCount;
    }

    public function increaseRolledDiceCount(): self
    {
        $this->rolledDiceCount++;

        return $this;
    }

    public function resetGameForWaitingStage(): self
    {
        $this->rolledDiceCount = 0;
        $this->rolledBlackDiceCount = 0;
        $this->rolledWhiteDiceCount = 0;
        $this->version = null;
        $this->stage = self::STAGE_WAITING;
        $this->messages = [];

        return $this;
    }

    public function resetGameForSelectingStage(): self
    {
        $this->rolledDiceCount = 0;
        $this->rolledBlackDiceCount = 0;
        $this->rolledWhiteDiceCount = 0;
        $this->version = null;
        $this->stage = self::STAGE_SELECTING;
        $this->messages = [];

        return $this;
    }

    public function getRolledWhiteDiceCount(): ?int
    {
        return $this->rolledWhiteDiceCount;
    }

    public function increaseRolledWhiteDiceCount(): self
    {
        $this->rolledWhiteDiceCount++;

        return $this;
    }

    public function getRolledBlackDiceCount(): ?int
    {
        return $this->rolledBlackDiceCount;
    }

    public function increaseRolledBlackDiceCount(): self
    {
        $this->rolledBlackDiceCount++;

        return $this;
    }
}
