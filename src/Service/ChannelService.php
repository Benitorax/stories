<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\Channel;
use App\Entity\Game;
use App\Repository\ChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChannelService
{
    private $entityManager;
    private $passwordEncoder;
    private $channelRepository;

    // need to try with PasswordEncoderInterface
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder, ChannelRepository $channelRepository)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->channelRepository = $channelRepository;
    }

    public function createChannel($data)
    {
        $names = $this->channelRepository->findAllNames();
        foreach($names as $name) {
            if(strtolower($name['name']) == strtolower($data->name)) return 'Nom de partie déjà utilisé';
        }
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

    public function addUserTochannel($data, Channel $channel)
    {
        if($channel->getHasPassword()) {
            $isValid = $this->passwordEncoder->isPasswordValid($channel, $data->password);
            if(!$isValid) return 'Mauvais mot de passe';
        }

        $users = $channel->getUsers();
        foreach($users as $user) {
            if(strtolower($user->getUsername()) == strtolower($data->username)) {
                if($user->getIsConnected()) return 'Nom déjà utilisé';
                
                else {
                    $user->setIsConnected(true);
                    $channel->increaseUsersCount();
                    $this->entityManager->flush();
                    return ['user' => $user, 'channel' => $channel];
                }
            }
        }

        $user = $this->createUser($data->username);        
        $channel->addUser($user);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return ['user' => $user, 'channel' => $channel];
    }

    public function checkPassword(string $password, Channel $channel): ?User
    {
        if($channel->getHasPassword()) {
            $isValid = $this->passwordEncoder->isPasswordValid($channel, $password);
            if(!$isValid) return null;
        }
        
        $user = $this->createUser('spectator');        

        return $user;
    }

    private function createUser(string $username): User
    {
        $user = new User();
        return $user
            ->setId(uniqid())
            ->setToken(uniqid())
            ->setUsername($username);
    } 

    public function disconnectUser(string $token, Channel $channel)
    {
        $users = $channel->getUsers();
        $connectedCount = 0;
        foreach($users as $user) {
            if($user->getToken() == $token && $user->getIsConnected() == true) {
                $user->setIsConnected(false);
                $channel->decreaseUsersCount();
            }
            if($user->getIsConnected() == true) $connectedCount++;
        }
        if($connectedCount == 0) {
            foreach($users as $user) $this->entityManager->remove($user);
            $this->entityManager->remove($channel);
        }
        $this->entityManager->flush();

        return $channel;
    }
}