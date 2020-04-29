<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Repository\ChannelRepository;
use App\Repository\UserRepository;
use App\Service\StoriesService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StoriesController extends AbstractController
{
    private $channelRepository;
    private $userRepository;

    public function __construct(ChannelRepository $channelRepository, UserRepository $userRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * @Route("/api/channel/{id}/dice/number", name="stories_roll_number_dice", methods={"POST"})
     */
    public function rollNumberDice(Request $request, Channel $channel, StoriesService $storiesService)
    {
        /** stdclass */
        $data = $this->getDecodedJsonDataFromRequest($request);

        $storyteller = $this->getStoryteller($data->token, $channel);
        if(!$storyteller) return $this->json([], 403);
        
        $channel = $storiesService->rollNumberDice($channel);
        
        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/dice/rating", name="stories_roll_dice_rating", methods={"POST"})
     */
    public function rollDiceForRating(Request $request, Channel $channel, StoriesService $storiesService)
    {
        /** stdclass */
        $data = $this->getDecodedJsonDataFromRequest($request);

        $storyteller = $this->getStoryteller($data->token, $channel);
        if(!$storyteller) return $this->json([], 403);
        
        $channel = $storiesService->rateStoryteller($storyteller, $channel);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/select-game-version", name="stories_select_game_version", methods={"POST"})
     */
    public function selectGameVersion(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $storyteller = $this->getStoryteller($data->token, $channel);
        if(!$storyteller) return $this->json([], 403);

        $channel = $storiesService->setGameVersion($channel, $data->version);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/dice/normal", name="stories_roll_normal_dice", methods={"POST"})
     */
    public function rollNormalDice(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $storyteller = $this->getStoryteller($data->token, $channel);
        if(!$storyteller) return $this->json([], 403);

        $channel = $storiesService->rollNormalDice($channel, $storyteller);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/dice/white", name="stories_roll_white_dice", methods={"POST"})
     */
    public function rollWhiteDice(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $storyteller = $this->getStoryteller($data->token, $channel);
        if(!$storyteller) return $this->json([], 403);

        $channel = $storiesService->rollWhitelDice($channel, $storyteller);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/dice/black", name="stories_roll_black_dice", methods={"POST"})
     */
    public function rollBlackDice(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $user = $this->getUserFromChannel($data->token, $channel);
        if(!$user) return $this->json([], 403);

        $channel = $storiesService->rollBlackDice($channel, $user);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/vote/second-roll", name="stories", methods={"POST"})
     */
    public function voteForAllowingSecondRoll(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $user = $this->getUserFromChannel($data->token, $channel);
        if(!$user) return $this->json([], 403);

        $channel = $storiesService->vote($user, $data->vote);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/subject", name="stories", methods={"POST"})
     */
    public function proposeSubject(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $user = $this->getUserFromChannel($data->token, $channel);
        if(!$user) return $this->json([], 403);

        $channel = $storiesService->proposeSubject($channel, $user);

        return $this->json([
            'channel' => $channel
        ]);
    }

    /**
     * @Route("/api/channel/{id}/vote/resolve", name="stories", methods={"POST"})
     */
    public function resolveVote(Request $request, Channel $channel, StoriesService $storiesService)
    {
        $data = $this->getDecodedJsonDataFromRequest($request);

        $channel = $storiesService->resolveVote($channel);

        return $this->json([
            'channel' => $channel
        ]);
    }

    public function getStoryteller(string $token, Channel $channel) 
    {
        $storyteller = $this->userRepository->findStorytellerByChannel($channel);
        if($storyteller->getToken() == $token) return $storyteller;
        
        return null;
    }

    public function getUserFromChannel(string $token, Channel $channel) 
    {
        $users = $this->userRepository->findAudienceTokensByChannel($channel);
        foreach($users as $user) {
            if($user->getToken() == $token) return $user;
        }

        return null;
    }

    public function getDecodedJsonDataFromRequest(Request $request)
    {
        $data = $request->getContent();
        /** stdclass */
        return json_decode($data);
    }
}
