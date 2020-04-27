<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Entity\User;
use App\Service\ChannelService;
use App\Repository\ChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app", methods={"GET"})
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
        ]);
    }

    /**
     * @Route("/api/channel", name="api_channel_list", methods={"GET"})
     */
    public function getAllChannels(ChannelRepository $channelRepository, SerializerInterface $serializer)
    {
        $channels = $channelRepository->findAllPublic();
        return $this->json([
            'channels' => $serializer->serialize($channels, 'json', ['groups' => 'public'])
        ]);
    }

    /**
     * @Route("/api/channel", name="api_channel_create", methods={"POST"})
     */
    public function createChannel(Request $request, ChannelService $channelService, SerializerInterface $serializer)
    {
        $data = $request->getContent();
        /** stdclass */
        $data = json_decode($data);

        $data = $channelService->createChannel($data);

        return $this->json([
            'user' => $serializer->serialize($data['user'], 'json', ['groups' => ['public', 'private', 'play']]),
            'channel' => $serializer->serialize($data['channel'], 'json', ['groups' => ['public']]),
        ]);
    }

    /**
     * @Route("/api/channel/{id}/check-password", name="api_channel_check_password", methods={"POST"})
     */
    public function checkPassword(Request $request, ChannelService $channelService, Channel $channel, SerializerInterface $serializer)
    {
        $data = $request->getContent();
        /** stdclass */
        $data = json_decode($data);

        $user = $channelService->checkPassword($data->password, $channel);
    
        if(!$user) {
            return $this->json([], 400);
        }

        return $this->json([
            'user' => $serializer->serialize($user, 'json', ['groups' => ['public', 'private']]),
            'channel' => $serializer->serialize($channel, 'json', ['groups' => ['public', 'private']])
        ]);
    }
    
    /**
     * @Route("/api/channel/{id}/user", name="api_channel_user_add", methods={"POST"})
     */
    public function addUserToChannel(Request $request, ChannelService $channelService, Channel $channel, SerializerInterface $serializer)
    {
        $data = $request->getContent();
        /** stdclass */
        $data = json_decode($data);

        $data2 = $channelService->addUserToChannel($data, $channel);
    
        if(!$data2) {
            return $this->json([], 400);
        }

        return $this->json([
            'user' => $serializer->serialize($data2['user'], 'json', ['groups' => ['public', 'private', 'play']]),
            'channel' => $serializer->serialize($data2['channel'], 'json', ['groups' => ['public']])
        ]);
    }

    /**
     * @Route("/api/channel/{id}", name="api_channel", methods={"GET"})
     */
    public function getChannel(Request $request, ChannelService $channelService, Channel $channel, SerializerInterface $serializer)
    {
        if($channel->getHasPassword()) {
            return $this->json([], 400);
        }

        $user = (new User())->setUsername('spectator');

        return $this->json([
            'user' => $serializer->serialize($user, 'json', ['groups' => ['public']]),
            'channel' => $serializer->serialize($channel, 'json', ['groups' => ['public', 'private']])
        ]);
    }

    /**
     * @Route("/test/{id}", name="test", methods={"GET"})
     */
    public function test(ChannelRepository $channelRepository, SerializerInterface $serializer, Channel $channel, ChannelService $channelService)
    {

    }
}
