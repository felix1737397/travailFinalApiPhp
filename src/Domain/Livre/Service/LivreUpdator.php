<?php
namespace App\Domain\Livre\Service;
use App\Domain\Livre\Repository\LivreUpdatorRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class LivreUpdator
{
    /**
     * @var LivreUpdatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LivreUpdatorRepository $repository The repository
     */
    public function __construct(LivreUpdatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new livre.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function updateLivre(array $data, $isbn): bool
    {
        // Input validation
        $this->validateUpdateLivre($data);

        // Insert livre
        $reussite = $this->repository->updateLivre($data, $isbn);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $reussite;
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
    private function validateUpdateLivre(array $data): void
    {
        $errors = [];

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
