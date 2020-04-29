<?php
namespace App\Service;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Channel;
use App\Manager\SubjectData;
use App\Manager\AudienceDice;
use App\Manager\StoryTellerDice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class StoriesService
{
    const NORMAL_VERSION = 'normal';
    const WHITE_DICE_VERSION = 'white dice';

    private $entityManager;
    private $storyteller;
    private $audienceDice;
    private $subjectData;

    public function __construct(EntityManagerInterface $entityManager, StoryTellerDice $storyteller, AudienceDice $audienceDice, SubjectData $subjectData)
    {
        $this->entityManager = $entityManager;
        $this->storyteller = $storyteller;
        $this->audienceDice = $audienceDice;
        $this->subjectData = $subjectData;
    }

    public function setGameVersion(Channel $channel, string $version)
    {
        $game = $channel->getGame();
        $game->setVersion($version);
        $this->entityManager->flush();

        return $channel;
    }

    public function rollNumberDice(Channel $channel)
    {
        $game = $channel->getGame();
        $dice1 = rand(1,6);
        $dice2 = rand(1,6);
        $this->setNewMessageInsideGame('Master', 'Lancé de dés : [ '.$dice1.' ] et [ '.$dice2.' ]', $game);
        
        if($dice1 == $dice2) {
            $subject = $this->subjectData->getOneSubject();
            $this->setNewMessageInsideGame('Master', 'Sujet : '.$subject, $game);
        }

        return $channel;
    }

    public function rollNormalDice(Channel $channel, User $user)
    {
        $game = $channel->getGame();
        $message = $this->resolveRollNormalDice($game);
        $this->setNewMessageInsideGame($user, $message, $game);

        return $channel;
    }

    public function rollWhitelDice(Channel $channel, User $user)
    {
        $game = $channel->getGame();
        $message = $this->storyteller->getOneWhiteSentence();
        $this->setNewMessageInsideGame($user, $message, $game);

        return $channel;
    }

    public function rollBlackDice(Channel $channel, User $user)
    {
        $game = $channel->getGame();
        $message = $this->audienceDice->getOneSentence();
        $this->setNewMessageInsideGame($user, $message, $game);

        return $channel;
    }

    public function proposeSubject(Channel $channel, User $user)
    {
        $game = $channel->getGame();
        $message = $this->subjectData->getOneSubject();
        $this->setNewMessageInsideGame($user, $message, $game);

        return $channel;
    }

    public function vote(User $user, string $vote)
    {
        $user->setVote($vote);
        $this->entityManager->flush();
    }

    public function rateStoryteller(User $user, Channel $channel)
    {
        $dice1 = rand(1,6);
        $dice2 = rand(1,6);
        $this->setNewMessageInsideGame('Master', 'Lancé de dés : [ '.$dice1.' ] et [ '.$dice2.' ]', $channel->getGame());

        $user->setPoints($dice1+$dice2);
        $this->entityManager->flush();

        return $channel;
    }

    public function resolveVote(Channel $channel)
    {
        $users = $channel->getUsers();
        $UserCount = $users->count();
        $yesCount = 0;
        $noCount = 0;
        $nullCount = 0;
        foreach($users as $user) {
            switch($user->getVote()) {
                case 'yes':
                    return $yesCount++;
                    break;
                case 'no':
                    return $noCount++;
                    break;
                case null:
                    return $nullCount++;
                    break;
            }
        }

        // TODO: MAKE ALLOWING SECOND RATING OR NOT
        return $channel;
    }

    public function setNewMessageInsideGame($user, string $newMessage, Game $game)
    {
        $username = '';
        if($user instanceof User) $username = $user->getUsername();
        else $username = $user;
        $newMessageLine = ['username' => $username, 'text' => $newMessage];

        $messages = $game->getMessages();
        array_push($messages, $newMessageLine);
        $game->setMessages($messages);
        $game->increaseRolledDiceCount();
        $this->entityManager->flush();
    }

    public function resolveRollNormalDice(Game $game)
    {
        $version = $game->getVersion();
        $rolledDiceCount = $game->getRolledDiceCount();
        if($version == self::NORMAL_VERSION) {
            switch ($rolledDiceCount) {
                case 0:
                    return $this->storyteller->getOneYellowSentence();
                    break;
                case 1:
                    return $this->storyteller->getOneOrangeSentence();
                    break;
                case 2:
                    return $this->storyteller->getOneRedSentence();
                    break;
                case 3:
                    return $this->storyteller->getOneVioletSentence();
                    break;
                case 4:
                    return $this->storyteller->getOneBlueSentence();
                    break;
                case 5:
                    return $this->storyteller->getOneDarkBlueSentence();
                    break;
                default:
                    return null;
                    break;
            }
        } elseif($version == self::WHITE_DICE_VERSION) {
            switch ($rolledDiceCount) {
                case 0:
                    return $this->storyteller->getOneYellowSentence();
                    break;
                case 1:
                    return $this->storyteller->getOneOrangeSentence();
                    break;
                case 2:
                    return $this->storyteller->getOneRedSentence();
                    break;
                case 3:
                    return $this->storyteller->getOneVioletSentence();
                    break;
                case 4:
                    return $this->storyteller->getOneBlueSentence();
                    break;
                default:
                    return null;
                    break;        
            }
        }
    }
}