<?php

namespace App\Model;

class RateManager extends AbstractManager
{
    public const TABLE = 'rating';

    /**
     * Insert new item in database
     */
    public function insert(array $rate): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (rate, game_id) VALUES (:rate, :id)");
        $statement->bindValue('rate', $rate[1], \PDO::PARAM_STR);
        $statement->bindValue('id', $rate[0], \PDO::PARAM_STR);

        $statement->execute();
        return $rate[0];
    }
}
