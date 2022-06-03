<?php

namespace App\Model;

class FavoriteManager extends AbstractManager
{
    public const TABLE = 'favorite';

    public function addToFavorite(array $identification)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO favorite (user_id, game_id) VALUES (:userid, :gameid);");
        $statement->bindValue('userid', $identification[1], \PDO::PARAM_INT);
        $statement->bindValue('gameid', $identification[0], \PDO::PARAM_INT);
        $statement->execute();
    }

    public function showFavorite(int $userId)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT g.id, g.description, g.image, g.icon, g.name, g.link 
        FROM game g INNER JOIN favorite f ON g.id=f.game_id WHERE f.user_id=:id GROUP BY g.id;");
        $statement->bindValue('id', $userId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function deleteFavorite(int $userId, $gameId)
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM favorite WHERE user_id=:userid AND game_id=:gameid;");
        $statement->bindValue('userid', $userId, \PDO::PARAM_INT);
        $statement->bindValue('gameid', $gameId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
