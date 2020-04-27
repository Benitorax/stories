<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Channel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    const CHANNELS = [
        [
            'name' => 'Les enfoirés',
            'usersMax' => 6,
            'hasPassword' => 1,
            'password' => '789789',
            'isPublic' => 1,
            'username' => 'Bryan'
        ],
        [
            'name' => 'For hardcore gamers',
            'usersMax' => 10,
            'hasPassword' => 0,
            'password' => '',
            'isPublic' => 1,
            'username' => 'Roger'
        ],
        [
            'name' => 'Les minables',
            'usersMax' => 8,
            'hasPassword' => 1,
            'password' => '456456',
            'isPublic' => 0,
            'username' => 'John'
        ],
        [
            'name' => 'Les inconnus',
            'usersMax' => 8,
            'hasPassword' => 0,
            'password' => '',
            'isPublic' => 0,
            'username' => 'Ben'
        ],
    ];

    const USERNAME = 'YOUWOULDNEVERGUESSTHISNAMEFORTHISGAME';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        foreach(self::CHANNELS as $channelData) {
            $channel = new Channel();

            $data = $this->hydrateChannel($channel, $channelData);
            $manager->persist($data['channel']);
            $manager->persist($data['user']);
        }
        $manager->flush();
    }

    public function hydrateChannel(Channel $channel, $channelData)
    {
        $encodedPassword = $this->passwordEncoder->encodePassword($channel, $channelData['password']);

        $user = new User();
        $user
            ->setId(uniqid())
            ->setToken(uniqid())
            ->setUsername($channelData['username']);

        $channel
            ->setId(uniqid())
            ->setName($channelData['name'])
            ->setHasPassword($channelData['hasPassword'])
            ->setIspublic($channelData['isPublic'])
            ->setPassword($encodedPassword)
            ->addUser($user)
            ->setUsersMax($channelData['usersMax'])
            ->setGame(new Game());

        return [
            'user' => $user,
            'channel' => $channel
        ];

    }
}
