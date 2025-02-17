<?php

namespace App\Controller;

use App\Service\CardGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class CardGameController extends AbstractController
{
    public function __construct(
        private CardGameService $cardGameService
    ) {}

    #[Route('/draw', name: 'draw_hand', methods: ['GET'])]
    public function drawHand(): JsonResponse
    {
        $hand = $this->cardGameService->generateRandomHand();
        $sortedHand = $this->cardGameService->sortHand($hand);

        return $this->json([
            'initial_hand' => $hand,
            'sorted_hand' => $sortedHand
        ]);
    }
}
