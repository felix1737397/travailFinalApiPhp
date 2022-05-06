<?php
namespace App\Action\Livre;

use App\Domain\Livre\Service\LivreViewService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreCreateAction
{
    private $livreView;

    public function __construct(LivreViewService $livreViewService)
    {
        $this->livreViewService = $livreViewService;
    }


    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {  
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $livreId = $this->livreViewService->createLivre($data);

        // Transform the result into the JSON representation
        $result = [
            'id_livre' => $livreId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
