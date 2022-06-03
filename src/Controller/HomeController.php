<?php

namespace App\Controller;

use App\Model\GameManager;

class HomeController extends AbstractController
{

    public function index(): string
    {
        $gameManager = new GameManager();
        $gameRating = $gameManager->selectAllRating();
        $gamePopularity = $gameManager->selectAllPopularity();
        $gameParty = $gameManager->selectAllParty();
        $gameWc = $gameManager->selectAllWC();
        $gameRecent = $gameManager->selectRecent();

        return $this->twig->render('Home/index.html.twig', [
            'games' => [$gameRating, $gamePopularity, $gameParty, $gameWc, $gameRecent]
        ]);
    }
}
