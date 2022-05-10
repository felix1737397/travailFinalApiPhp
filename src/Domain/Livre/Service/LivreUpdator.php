<?php
namespace App\Domain\Livre\Service;
use App\Domain\Livre\Repository\LivreUpdatorRepository;
use App\Exception\ValidationException;
use PDO;

/**
 * Service.
 */
final class LivreUpdator
{
    /**
     * @var LivreUpdatorRepository
     */
    private $repository;
    private $connection;


    /**
     * The constructor.
     *
     * @param LivreUpdatorRepository $repository The repository
     */
    public function __construct(LivreUpdatorRepository $repository, PDO $connection)
    {
        $this->repository = $repository;
        $this->connection = $connection;

    }
    
    /**
     * Create a new livre.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function updateLivre(array $data, $isbn, $cleApi): bool
    {
        // Input validation
        $this->validateUpdateLivre($data, $cleApi);

        // Insert livre
        $reussite = $this->repository->updateLivre($data, $isbn, $cleApi);

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
    private function validateUpdateLivre(array $data, $cleApi): void
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
        if (empty($cleApi)) {
            $errors['cleApi'] = 'Input required';
        }
        else{
            $sqlApi = "SELECT cle_api FROM user WHERE cle_api = ?";
            $stmt = $this->connection->prepare($sqlApi);
            $stmt->execute([$cleApi]);
            if($stmt->rowCount() == 0){
                $errors['cleApi'] = 'Input required';
            }
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
