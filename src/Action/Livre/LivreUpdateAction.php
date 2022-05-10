<?php
namespace App\Action\Livre;
use App\Domain\Livre\Service\LivreUpdator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreUpdateAction
{
    private $livreUpdator;

    public function __construct(livreUpdator $livreUpdator)
    {
        $this->livreUpdator = $livreUpdator;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect input from the HTTP request

        $data = (array)$request->getParsedBody();

        $isbn = $request->getAttribute('isbn', 0);
        $cleApi = $request->getAttribute('cleApi', 0);

        
        $result = $this->livreUpdator->updateLivre($data, $isbn, $cleApi);

        if ($result == true){

            $result = [
                'message' => 'Livre modifié avec succès',
                'livre_isbn' => $isbn
            ];

            // build the HTTP response
            $response->getBody()->write((string)json_encode($result));

            return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
        }
        else 
        {
        // build the HTTP response
        $result = ['Unauthorized'];

        $response->getBody()->write((string)json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(401);
    }
}
}
