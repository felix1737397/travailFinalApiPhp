<?php
namespace App\Action\Livre;
use App\Domain\Livre\Service\LivreViewService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LivreViewAction
{
    private $livreView;

    public function __construct(LivreViewService $livreViewService)
    {
        $this->livreViewService = $livreViewService;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $livre = $this->livreViewService->viewAllLivre();
        $response->getBody()->write((string)json_encode($livre));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
