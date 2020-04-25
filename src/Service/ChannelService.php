<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\Channel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChannelService
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createChannel(UserInterface $commonUser, $data): Channel
    {
        $channel = new Channel();
        $encodedPassword = $this->passwordEncoder->encodePassword($commonUser, $data->password);

        $user = new User();
        $user
        ->setId(uniqid())
        ->setUsername($data->username);

        $channel
        ->setId(uniqid())
        ->setName($data->name)
        ->setHasPassword($data->hasPassword)
        ->setIspublic($data->isPublic)
        ->setPassword($encodedPassword)
        ->addUser($user)
        ->setUsersMax($data->usersMax);

        $this->entityManager->persist($channel);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $channel;
    }
}