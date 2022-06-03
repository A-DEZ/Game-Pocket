<?php

namespace App\Model;

class CommentManager extends AbstractManager
{
    public const TABLE = 'commentary';

    public function add(array $comment): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (content, user_id, game_id, created_at) VALUES (:content, :userId, :id, NOW() )");
        $statement->bindValue('content', $comment[1], \PDO::PARAM_STR);
        $statement->bindValue('id', $comment[0], \PDO::PARAM_STR);
        $statement->bindValue('userId', $comment[2], \PDO::PARAM_INT);
        $statement->execute();
        return $comment[0];
    }

    public function selectComment(int $id)
    {
        // prepared request
        $comment = $this->pdo->prepare("SELECT commentary.id, commentary.content, commentary.created_at, 
        user.username, user.avatar  
        FROM game
        LEFT JOIN commentary ON game.id=commentary.game_id 
        LEFT JOIN user ON commentary.user_id=user.id 
        WHERE game.id=:id ORDER BY commentary.created_at DESC;");
        $comment->bindValue('id', $id, \PDO::PARAM_INT);
        $comment->execute();
        return $comment->fetchAll();
    }
}
