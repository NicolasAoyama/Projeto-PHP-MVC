<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\UserRepository;

class LoginValidationController implements Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password");
        $userData = $this->userRepository->verifyUser($email, $password);
        if ($userData){
            header("location: /");
        } else {
            header("location: /login?sucesso=0");
        }
        
    }
}
