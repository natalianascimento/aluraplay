<?php

namespace Alura\Mvc\Repository;

use PDO;
use Alura\Mvc\Entity\User;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {

    }

    public function searchUserByEmail(User $user)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->email);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePasswordAlgorithm(User $password, $id)
    {
        $sql = 'UPDATE users SET password = ? WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
        $statement->bindValue(2, $id);
        $statement->execute();
    }

}