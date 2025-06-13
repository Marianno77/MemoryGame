<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeckWithCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deckFruits = Deck::create([
            'name' => 'Fruits',
            'image' => 'cards/fruits.png',
            'difficulty' => 'medium',
        ]);

        $this->cardGenerator($deckFruits, 8);

        $deckFlags = Deck::create([
            'name' => 'Flags',
            'image' => 'cards/flags.png',
            'difficulty' => 'hard',
        ]);

        $this->cardGenerator($deckFlags, 12);

        $deckFastFood = Deck::create([
            'name' => 'FastFood',
            'image' => 'cards/fastFood.png',
            'difficulty' => 'easy',
        ]);

        $this->cardGenerator($deckFastFood, 4);
    }

    public function cardGenerator($deck, $length) {
        for($i = 1; $i <= $length; $i++) {
            Card::create([
                'deck_id' => $deck->id,
                'name' => 'Card_nr_' . $i,
                'image' => 'cards/deck_nr_' . $deck->id . '_card_nr_' . $i . '.png',
            ]);
        }
    }
}
