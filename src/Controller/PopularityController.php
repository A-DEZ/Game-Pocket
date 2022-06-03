<?php

namespace App\Controller;

use App\Model\GameManager;

class PopularityController extends AbstractController
{

    public function popularity(string $url, int $id)
    {
            $gameManager = new GameManager();
            $gameManager->incrementPopularity($id);
            header('Location:' . $url);
    }
}
