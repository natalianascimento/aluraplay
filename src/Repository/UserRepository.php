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

}