<?php
namespace App\Domain\Livre\Service;
use App\Domain\Livre\Repository\LivreDeletorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class LivreDeletor
{
    /**
     * @var LivreDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LivreDeletorRepository $repository The repository
     */
    public function __construct(LivreDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Supprimer un utilisateur selon son ID
     *
     * @param $id de l'utilisateur
     */
    public function deleteLivre($isbn)
    {
        $this->repository->deleteLivre($isbn);

    }
}
