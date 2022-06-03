<?php

namespace App\Model;

class GameFilterManager extends AbstractManager
{
    private function getFilters($query)
    {
        $filters = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $isOnline = $_POST['gameMode'];
            $isSolo = $_POST['gameGenre'];
            $lasting = $_POST['gameDuration'];
            if ($isOnline) {
                $filters[] = " is_online = $isOnline ";
            }
            if ($isSolo) {
                $filters[] = " is_solo = $isSolo ";
            }
            if ($lasting) {
                $filters[] = " lasting = '$lasting' ";
            }
            if (!empty($filters)) {
                $query .= 'WHERE ' . implode(" AND ", $filters);
            }
        }
            return $query;
    }

    public function selectGameAll()
    {
        $query = "SELECT game.id, game.name, game.image, game.icon,
    game.description, game.video, game.link, ROUND(AVG(rating.rate), 0) AS average
    FROM game LEFT JOIN rating ON game.id=rating.game_id ";
        $queryFinal = $this->getFilters($query);
        $queryFinal .= "GROUP BY game.id";
        $statement = $this->pdo->query($queryFinal);
        $gameAll = $statement->fetchAll();
        return $gameAll;
    }

    public function popularityFilter()
    {
        $query = "SELECT game.name, game.description, game.popularity, game.image, game.link, game.id, 
                  ROUND(AVG(r.rate), 0) 
                  AS average
                  FROM game
                  LEFT JOIN rating r on game.id = r.game_id ";
        $queryFinal = $this->getFilters($query);
        $queryFinal .= "GROUP BY game.name, game.description,
         game.popularity, game.image, game.link, game.date, game.id 
        ORDER BY game.popularity DESC";
        $statement = $this->pdo->query($queryFinal);
        return $statement->fetchAll();
    }

    public function dateFilter()
    {
        $query = "SELECT game.name, game.description, game.popularity, game.image, game.link, game.id, 
                  ROUND(AVG(r.rate), 0) 
                  AS average
                  FROM game
                  LEFT JOIN rating r on game.id = r.game_id ";
        $queryFinal = $this->getFilters($query);
        $queryFinal .= "GROUP BY game.name, game.description, game.popularity, game.image, game.link, game.date, game.id
                  ORDER BY game.date DESC";
        $statement = $this->pdo->query($queryFinal);
        return $statement->fetchAll();
    }

    public function rateFilter()
    {
        $query = "SELECT game.name, game.description, game.popularity, game.image, game.link, 
                  ROUND(AVG(r.rate), 0) AS average
                  FROM game
                  LEFT JOIN rating r on game.id = r.game_id ";
        $queryFinal = $this->getFilters($query);
        $queryFinal .= "GROUP BY game.name, game.description, game.popularity, game.image, game.link
                  ORDER BY average DESC";
        $statement = $this->pdo->query($queryFinal);
        return $statement->fetchAll();
    }
}
