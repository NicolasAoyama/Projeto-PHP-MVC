<?php 
namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\User;
use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }
    public function formarObjeto(array $user): User
    {
        return new User(
            $user['id'],
            $user['email'],
            $user['password']
        );
    }
    public function addUser(User $user): bool
    {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->getEmail());
        $statement->bindValue(2, $user->getPassword());
        return $statement->execute();
    }
    public function verifyUser(string $email, string $password): bool
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($userData === false){
            return false;
        }

        if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)){
            $sql2 = "UPDATE users SET password = ? WHERE id = ?";
            $statement = $this->pdo->prepare($sql2);
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $userData['id']);
        }
        return password_verify($password, $userData['password']);


    }
}