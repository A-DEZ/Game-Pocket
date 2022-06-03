<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    /**
     * Insert new item in database
     */
    public function checkUser($username)
    {
        $statement = $this->pdo->prepare("SELECT * FROM user WHERE username=:username;");
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }

    public function newRegister(array $newUser): void
    {
        $query = 'INSERT INTO user (username, name, mail, password, role, created_at, avatar) 
        VALUES (:username, :name, :mail, :password, :role, NOW(), :avatar)';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':username', $newUser[0], \PDO::PARAM_STR);
        $statement->bindValue(':name', $newUser[1], \PDO::PARAM_STR);
        $statement->bindValue(':mail', $newUser[2], \PDO::PARAM_STR);
        $statement->bindValue(':password', $newUser[3], \PDO::PARAM_STR);
        $statement->bindValue(':role', $newUser[4], \PDO::PARAM_STR);
        $statement->bindValue(':avatar', $newUser[5], \PDO::PARAM_STR);
        $statement->execute();
    }
}
