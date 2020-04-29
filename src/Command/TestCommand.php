<?php

namespace App\Command;

use App\Entity\Channel;
use App\Repository\UserRepository;
use App\Repository\ChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';
    private $userRepository;
    private $channelRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, ChannelRepository $channelRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->channelRepository = $channelRepository;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $channel = $this->channelRepository->findOneBy(['id' => '5ea89e8446431']);
        // $data = $this->userRepository->findStorytellerTokenByChannel($channel);
        // $data = $this->userRepository->findStorytellerByChannel('5ea89e8446431');
        // $tokenArray = $this->userRepository->findAudienceTokensByChannelId('5ea89e8446431');
        $data = $this->userRepository->findStorytellerTokenByChannel($channel);
        // foreach($tokenArray as $token) {
        //     dump($token['token']);
        // }
        //$this->doingThingsApart($channel);
        dump($data);


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }

    public function doingThingsApart(Channel $channel)
    {
        $game = $channel->getGame();
        $game->setVersion('white dice');
        //$this->entityManager->persist($channel);
        $this->entityManager->flush();
        
        return $channel;
    }
}
