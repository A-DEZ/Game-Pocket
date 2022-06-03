<?php

namespace App\Controller;

use App\Model\FavoriteManager;

class FavoriteController extends AbstractController
{
    /**
     * List items
     */
    public function add(int $id): void
    {
        $favoriteManager = new FavoriteManager();
        $userId = $_SESSION['user']['id'];
        $favoriteManager->addToFavorite([$id, $userId]);
        header('Location:/games/show?id=' . $id);
    }

    public function showFavorite()
    {
        $favoriteManager = new FavoriteManager();
        $userId = $_SESSION['user']['id'];
        $favorites = $favoriteManager->showFavorite($userId);

        return $this->twig->render('User/favorite.html.twig', [
            "favorites" => $favorites
        ]);
    }

    public function delete(int $gameId)
    {
        $favoriteManager = new FavoriteManager();
        $userId = $_SESSION['user']['id'];
        $favoriteManager->deleteFavorite($userId, $gameId);
        header('Location:/user/favorite');
    }
}
