<?php

namespace App\Domain\Livre\Service;
use App\Domain\Livre\Repository\LivreCreatorRepository;
use App\Domain\Livre\Repository\LivreViewRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class LivreViewService
{
    /**
     * @var LivreViewRepository
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The constructor.
     *
     * @param LivreViewRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(LivreViewRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger
            ->addFileHandler('Transaction.log')
            ->createLogger("LivreView");
    }


    public function viewAllLivre(): array
    {
        $infos = $this->repository->selectAllLivre();

        $this->logger->info("Ce n'est surtout pas un exemple de comment logger un message");

        return $infos;
    }

    public function createLivre(array $data): int
    {
        // Input validation
        $this->validateNewLivre($data);

        // Insert livre
        $livreId = $this->repository->insertLivre($data);

        // Logging here: Livre created successfully
        $this->logger->info(sprintf('Livre created successfully: %s', $livreId));

        return $livreId;
    }
    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewLivre(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['prenom_auteur'])) {
            $errors['prenom_auteur'] = 'Input required';
        }
        if (empty($data['nom_famille_auteur'])) {
            $errors['prenom_auteur'] = 'Input required';
        }
        if (empty($data['titre'])) {
            $errors['titre'] = 'Input required';
        }
        if (empty($data['nb_page'])) {
            $errors['nb_page'] = 'Input required';
        }
        if (empty($data['isbn'])) {
            $errors['isbn'] = 'Input required';
        }
        if (empty($data['date_publication'])) {
            $errors['date_publication'] = 'Input required';
        }
        if (empty($data['langue'])) {
            $errors['langue'] = 'Input required';
        }
        if (empty($data['collection'])) {
            $errors['collection'] = 'Input required';
        }
        if (empty($data['tome'])) {
            $errors['tome'] = 'Input required';
        }
        if (empty($data['image'])) {
            $errors['image'] = 'Input required';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
