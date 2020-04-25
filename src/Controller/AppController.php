<?php

namespace App\Controller;

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
        return $this->json($serializer->serialize($channels, 'json', ['groups' => 'frontend']));
    }

    /**
     * @Route("/api/channel", name="api_channel_create", methods={"POST"})
     */
    public function createChannel(Request $request, ChannelService $channelService, SerializerInterface $serializer)
    {
        $data = $request->getContent();
        /** stdclass */
        $data = json_decode($data);

        $user = new User();
        $channel = $channelService->createChannel($user, $data);

        return $this->json($serializer->serialize($channel, 'json', ['groups' => 'frontend']));
    }
    
}
