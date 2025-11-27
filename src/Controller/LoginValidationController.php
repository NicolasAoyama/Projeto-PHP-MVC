<?php 
namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\UserRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginValidationController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($parsedBody['password']);
        $correctPass = $this->userRepository->verifyUser($email, $password);

        if ($correctPass){
            $_SESSION['logado'] = true;
            return new Response(302, ['Location' => '/'] );
        } else {
            $this->addErrorMessage("Email ou senha Invalido");;
            return new Response(302, ['Location' => '/login'] );
        }
        
    }
}
