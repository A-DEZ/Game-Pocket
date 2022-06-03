<?php

namespace App\Controller;

use App\Model\RateManager;

class RateController extends AbstractController
{
    public function rate(int $id): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
            $rate = [$id, $_POST['rating']];
            // TODO validations (length, format...)
            // if validation is ok, insert and redirection
            $rateManager = new RateManager();
            $id = $rateManager->insert($rate);
            header('Location:/games/show?id=' . $id);
        }

        return $this->twig->render('Game/show.html.twig');
    }
}
