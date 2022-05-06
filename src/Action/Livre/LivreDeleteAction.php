<?php

namespace App\Action\Livre;
use App\Domain\Livre\Service\LivreDeletor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreDeleteAction
{
    private $livreDeletor;

    public function __construct(livreDeletor $livreDeletor)
    {
        $this->livreDeletor = $livreDeletor;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        if(isset($args['isbn'])){
            $isbn = intval($args['isbn']);
            $this->livreDeletor->deleteLivre($isbn);
            $result = ['success'=> true];
            $response->getBody()->write((string)json_encode($result));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } else {
            //Pas de ID
            $result = ['success'=> false];
            $response->getBody()->write((string)json_encode($result));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
    }
}
