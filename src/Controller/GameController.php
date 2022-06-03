<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\RateManager;
use App\Service\FormService;
use App\Model\GameFilterManager;
use App\Model\CommentManager;

class GameController extends AbstractController
{
    /**
     * List items
     */
    public function show(int $id): string
    {
        $gameManager = new GameManager();
        $commentManager = new CommentManager();
        $game = $gameManager->selectAllbyId($id);
        $content = $commentManager->selectComment($id);

        return $this->twig->render('Game/show.html.twig', [
            "game" => [$game, $content, $_SESSION]
        ]);
    }

    public function gameAll(): string
    {
        $gameAll = [];
        $gameFilterManager = new GameFilterManager();
        if (isset($_GET['sort'])) {
            if ($_GET['sort'] === 'popularity') {
                $gameAll = $gameFilterManager->popularityFilter();
            } elseif ($_GET['sort'] === 'rate') {
                $gameAll = $gameFilterManager->rateFilter();
            } elseif ($_GET['sort'] === 'date') {
                $gameAll = $gameFilterManager->dateFilter();
            }
        } else {
            $gameAll = $gameFilterManager->selectGameAll();
        }
        return $this->twig->render('Game/index.html.twig', [
            "gameAll" => $gameAll
        ]);
    }

    public function addGame(): string
    {
        $formService = new FormService();
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $gameName = $formService->testInput($_POST["gameName"]);
            $linkGame = $formService->testInput($_POST['linkGame']);
            $dateGame = $_POST['dateGame'];
            $descriptionGame = $formService->testInput($_POST["descriptionGame"]);
            $gameOnline = $formService->testInput($_POST['gameOnline']);
            $gameSolo = $formService->testInput($_POST['gameSolo']);
            $lastingGame = $formService->testInput($_POST['lastingGame']);
            $userId = $_SESSION['user']['id'];
            $required = ['gameName', 'linkGame', 'gameOnline'
            , 'gameSolo', 'lastingGame', 'descriptionGame', 'dateGame'];
            // File upload

            $folder = "../public/assets/images/";
            $extIcon = pathinfo($_FILES['iconGame']['name'], PATHINFO_EXTENSION);
            $extImage = pathinfo($_FILES['imageGame']['name'], PATHINFO_EXTENSION);
            $uniqIcon = uniqid('', true);
            $uniqImage = uniqid('', true);
            $iconGame = $uniqIcon . "." . $extIcon;
            $imageGame = $uniqImage . "." . $extImage;

            // errors
            $formService->emptyCheck($required);
            $formService->extensionCheck($extIcon);
            $formService->extensionCheck($extImage);
            $formService->sizeCheck($_FILES['iconGame']['tmp_name']);
            $formService->sizeCheck($_FILES['imageGame']['tmp_name']);
            $formService->textCheck($gameName);
            $formService->textCheck($descriptionGame);
            $formService->validateDate($dateGame, 'Y-m-d');
            $formService->urlCheck($linkGame);
            $newGame = [
                $gameName, $linkGame, $gameOnline, $gameSolo, $lastingGame, $descriptionGame,
                $iconGame, $imageGame, $dateGame, $userId
            ];
            //Uploading images
            move_uploaded_file($_FILES['iconGame']['tmp_name'], $folder . $iconGame);
            move_uploaded_file($_FILES['imageGame']['tmp_name'], $folder . $imageGame);

            if (empty($formService->getErrors())) {
                $gameManager = new GameManager();
                $gameManager->saveGame($newGame);
                $formService->success();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        return $this->twig->render('Game/gameForm.html.twig', [
            "errors" => $formService->getErrors(),
            "success" => $formService->getSuccessForm()
        ]);
    }

    public function search($query): string
    {
        $gameManager = new GameManager();
        $search = htmlspecialchars($query);
        $search = trim($search);
        $search = stripslashes($search);
        $search = strtolower($search);
        $answer = $gameManager->searchGame($search);

        return $this->twig->render('Game/search.html.twig', [
            "search" => $answer,
            "get" => $_GET,
        ]);
    }
}
