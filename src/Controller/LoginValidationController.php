<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\UserRepository;

class LoginValidationController implements Controller
{
    use FlashMessageTrait;
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password");
        $correctPass = $this->userRepository->verifyUser($email, $password);

        

        if ($correctPass){
            $_SESSION['logado'] = true;
            header("location: /");
        } else {
            $this->addErrorMessage("Email ou senha Invalido");;
            header("location: /login?sucesso=0");
        }
        
    }
}
