<?php

namespace App\Model;

class GameManager extends AbstractManager
{
    public const TABLE = 'game';

    public function selectAllById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT game.id, game.name, game.image, game.icon,
        game.description, game.video, game.link, ROUND(AVG(rating.rate), 0) AS average  
        FROM game LEFT JOIN rating ON game.id=rating.game_id GROUP BY game.id HAVING game.id=:id;");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function saveGame(array $newGame): void
    {
        $query = 'INSERT INTO game (name, date, link, is_online, is_solo, lasting, description, icon, image,
                  created_at, user_id) VALUES (:name, :date, :link, :is_online, :is_solo, :lasting, :description,
                                      :icon, :image, NOW(), :userid)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $newGame[0], \PDO::PARAM_STR);
        $statement->bindValue(':link', $newGame[1], \PDO::PARAM_STR);
        $statement->bindValue(':is_online', $newGame[2], \PDO::PARAM_BOOL);
        $statement->bindValue(':is_solo', $newGame[3], \PDO::PARAM_BOOL);
        $statement->bindValue(':lasting', $newGame[4], \PDO::PARAM_STR);
        $statement->bindValue(':description', $newGame[5], \PDO::PARAM_STR);
        $statement->bindValue(':icon', $newGame[6], \PDO::PARAM_STR);
        $statement->bindValue(':image', $newGame[7], \PDO::PARAM_STR);
        $statement->bindValue(':date', $newGame[8], \PDO::PARAM_STR);
        $statement->bindValue(':userid', $newGame[9], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function incrementPopularity(int $id)
    {
        $statement = $this->pdo->prepare("UPDATE game SET popularity = popularity +1 WHERE id=:id;");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function searchGame($search)
    {
        $requete = $this->pdo->prepare("SELECT * FROM game WHERE description 
        LIKE :search OR name LIKE :search;");
        $requete->bindValue(':search', "%" . $search . "%", \PDO::PARAM_STR);
        $requete->execute();
        $answer = $requete->fetchAll();
        return $answer;
    }

    public function selectAllRating(): array
    {
        $query =  "SELECT game.id, game.name, game.icon, ROUND(AVG(rating.rate), 0) AS average 
        FROM game LEFT JOIN rating ON game.id=rating.game_id GROUP BY game.id ORDER BY average DESC LIMIT 7;";
        $statement = $this->pdo->query($query);
        $gameRating = $statement->fetchAll();
        return $gameRating;
    }

    public function selectAllPopularity(): array
    {
        $query = "SELECT game.id, game.name, game.icon, ROUND(AVG(rating.rate), 0) AS average  
        FROM game LEFT JOIN rating ON game.id=rating.game_id GROUP BY game.id ORDER BY game.popularity DESC LIMIT 7;";
        $statement = $this->pdo->query($query);
        $gamePopularity = $statement->fetchAll();
        return $gamePopularity;
    }

    public function selectAllParty(): array
    {
        $query = "SELECT game.id, game.name, game.icon, ROUND(AVG(rating.rate), 0) AS average FROM game 
        LEFT JOIN rating ON game.id=rating.game_id WHERE game.is_online=1 GROUP BY game.id LIMIT 8;";
        $statement = $this->pdo->query($query);
        $gameParty = $statement->fetchAll();
        return $gameParty;
    }

    public function selectAllWc(): array
    {
        $query = "SELECT game.id, game.name, game.icon, ROUND(AVG(rating.rate), 0) AS average  
        FROM game LEFT JOIN rating ON game.id=rating.game_id GROUP BY game.id 
        ORDER BY game.lasting ASC LIMIT 8;";
        $statement = $this->pdo->query($query);
        $gameWc = $statement->fetchAll();
        return $gameWc;
    }

    public function selectRecent(): array
    {
        $query = "SELECT id, name , image, icon FROM game ORDER BY date DESC LIMIT 4;";
        $statement = $this->pdo->query($query);
        $gameRecent = $statement->fetchAll();
        return $gameRecent;
    }
}
