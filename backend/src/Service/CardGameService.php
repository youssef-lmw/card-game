<?php

namespace App\Service;

use App\Entity\Card;

class CardGameService
{
    public function generateRandomHand(): array
    {
        $deck = $this->generateDeck();
        shuffle($deck);
        return array_slice($deck, 0, 10);
    }

    public function sortHand(array $hand): array
    {
        usort($hand, function (Card $a, Card $b) {
            // Compare color first
            $colorComparison = array_search($a->getColor(), Card::COLORS) - array_search($b->getColor(), Card::COLORS);
            if ($colorComparison !== 0) {
                return $colorComparison;
            }
            
            // If color are equal, compare values
            return array_search($a->getValue(), Card::VALUES) - array_search($b->getValue(), Card::VALUES);
        });

        return $hand;
    }

    private function generateDeck(): array
    {
        $deck = [];
        foreach (Card::COLORS as $color) {
            foreach (Card::VALUES as $value) {
                $card = new Card();
                $card->setColor($color);
                $card->setValue($value);
                $deck[] = $card;
            }
        }
        return $deck;
    }
}
