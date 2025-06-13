<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function getCards($deckId) {
        $deck = Deck::findOrFail($deckId);
        $cards = $deck->cards;

        $cards = $cards->flatMap(function ($card) {
            return [$card, clone $card];
        });

        $cards = $cards->shuffle();

        return response()->json($cards);
    }
}
