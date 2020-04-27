<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\Channel;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChannelService
{
    private $entityManager;
    private $passwordEncoder;

    // need to try with PasswordEncoderInterface
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createChannel($data): array
    {
        $channel = new Channel();
        $encodedPassword = $this->passwordEncoder->encodePassword($channel, $data->password);

        $user = $this->createUser($data->username);        
        $channel
            ->setId(uniqid())
            ->setName($data->name)
            ->setHasPassword($data->hasPassword)
            ->setIspublic($data->isPublic)
            ->setPassword($encodedPassword)
            ->addUser($user)
            ->setUsersMax($data->usersMax)
            ->setGame(new Game());

        $this->entityManager->persist($channel);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return [
            'user' => $user,
            'channel' => $channel
        ];
    }

    public function addUserTochannel($data, Channel $channel): array
    {
        if($channel->getHasPassword()) {
            $isValid = $this->passwordEncoder->isPasswordValid($channel, $data->password);
            if(!$isValid) return false;
        }
        
        $user = $this->createUser($data->username);        
        $channel->addUser($user);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return [
            'user' => $user,
            'channel' => $channel
        ];
    }

    public function checkPassword(string $password, Channel $channel)
    {
        if($channel->getHasPassword()) {
            $isValid = $this->passwordEncoder->isPasswordValid($channel, $password);
            if(!$isValid) return false;
        }
        
        $user = $this->createUser('spectator');        

        return $user;
    }

    private function createUser(string $username): UserInterface
    {
        $user = new User();
        return $user
            ->setId(uniqid())
            ->setToken(uniqid())
            ->setUsername($username);
    } 
}