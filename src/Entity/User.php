<?php 
namespace Alura\Mvc\Entity;

class User
{
    public function __construct(
        public readonly ?int $id,
        private string $email,
        private string $password
    )
    {
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password):void
    {
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $this->password = $hash;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
}