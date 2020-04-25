<?php
namespace App\Service;

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

    public function createChannel(UserInterface $user, $data): Channel
    {
        $channel = new Channel();
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $data->password);

        $channel
        ->setId(uniqid())
        ->setName($data->name)
        ->setHasPassword($data->hasPassword)
        ->setIspublic($data->isPublic)
        ->setPassword($encodedPassword)
        ->setUsers([
            [
                'id' => uniqid(),
                'username' => $data->username, 
                'points' => 0
            ]
        ]);

        $this->entityManager->persist($channel);
        $this->entityManager->flush();

        return $channel;
    }
}