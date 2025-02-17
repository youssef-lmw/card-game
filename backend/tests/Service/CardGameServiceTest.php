<?php

namespace App\Tests\Service;

use App\Entity\Card;
use App\Service\CardGameService;
use PHPUnit\Framework\TestCase;

class CardGameServiceTest extends TestCase
{
    private CardGameService $cardGameService;

    protected function setUp(): void
    {
        $this->cardGameService = new CardGameService();
    }

    public function testGenerateRandomHandReturnsCorrectNumberOfCards(): void
    {
        $hand = $this->cardGameService->generateRandomHand();
        
        $this->assertCount(10, $hand);
        $this->assertContainsOnlyInstancesOf(Card::class, $hand);
    }

    public function testGenerateRandomHandReturnsUniqueCards(): void
    {
        $hand = $this->cardGameService->generateRandomHand();
        
        $uniqueCards = array_unique(array_map(function(Card $card) {
            return $card->getColor() . '-' . $card->getValue();
        }, $hand));
        
        $this->assertCount(10, $uniqueCards);
    }

    public function testSortHandSortsCardsByColorAndValue(): void
    {
        // Create a hand with known cards in random order
        $hand = [
            $this->createCard('Trèfle', '7'),
            $this->createCard('Coeur', 'AS'),
            $this->createCard('Pique', 'Roi'),
            $this->createCard('Carreaux', '10'),
        ];

        $sortedHand = $this->cardGameService->sortHand($hand);

        // Verify the order
        $this->assertEquals('Carreaux', $sortedHand[0]->getColor());
        $this->assertEquals('10', $sortedHand[0]->getValue());
        
        $this->assertEquals('Coeur', $sortedHand[1]->getColor());
        $this->assertEquals('AS', $sortedHand[1]->getValue());
        
        $this->assertEquals('Pique', $sortedHand[2]->getColor());
        $this->assertEquals('Roi', $sortedHand[2]->getValue());
        
        $this->assertEquals('Trèfle', $sortedHand[3]->getColor());
        $this->assertEquals('7', $sortedHand[3]->getValue());
    }

    private function createCard(string $color, string $value): Card
    {
        $card = new Card();
        $card->setColor($color);
        $card->setValue($value);
        return $card;
    }
}
