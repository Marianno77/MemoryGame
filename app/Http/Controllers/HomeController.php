<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home.home');
    }

    public function getDecks() {
        $decks = Deck::orderByRaw("
          CASE difficulty
            WHEN 'easy' THEN 1
            WHEN 'medium' THEN 2
            WHEN 'hard' THEN 3
          END
          ")->get();

        return response()->json($decks);
    }
}
