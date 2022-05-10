<?php
// Source : https://www.slimframework.com/docs/v4/concepts/middleware.html
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Domain\User\Repository\CleApiRepository;

class AuthMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  Request  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */

    private $repository;

    public function __construct(CleApiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $exploded = explode(' ', $request->getHeaderLine('Authorization'));
        if($exploded[0] == 'Basic'){

            $decoded = base64_decode($exploded[1]);
            $username = explode(":",$decoded)[0];
            $password = explode(":",$decoded)[1];

            if($username == null || $password == null){
                $response = new Response();
                $response->getBody()->write('Nom d\'utilisateur ou mot de passe invalide!');
                return $response->withStatus(401);
            }

            if(!$this->repository->validatePassword($username, $password)){
                $response = new Response();
                $response->getBody()->write('Mot de passe invalide!');
                return $response->withStatus(401);
            }

            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();

            $response = new Response();
            $response->getBody()->write(($existingContent));

            return $response
                ->withHeader('Content-Type', 'application/json');

        } else {
            $response = new Response();
            $response->getBody()->write('Veuillez utiliser un mot de passe encoder en base64 pour accéder à cette route');
            return $response->withStatus(401);
        }
    }
}
