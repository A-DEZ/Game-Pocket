<?php

namespace App\Controller;

use App\Model\CommentManager;

class CommentController extends AbstractController
{


    public function add(int $id): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
            $testComment = trim($_POST['message']);
            $testComment = stripslashes($testComment);
            $testComment = htmlspecialchars($testComment);

            $comment = [$id, $testComment, $_SESSION['user']['id']];
            $commentManager = new CommentManager();
            $id = $commentManager->add($comment);
            header('Location:/games/show?id=' . $id);
        }
        return $this->twig->render('Game/show.html.twig');
    }
}
