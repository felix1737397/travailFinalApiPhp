<?php

namespace App\Domain\Livre\Repository;

use PDO;

/**
 * Repository.
 */
class LivreDeletorRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Deletes a user row.
     *
     * @param int $id the user's id
     */
    public function deleteLivre(int $isbn)
    {
        $sql = "DELETE FROM livre WHERE isbn = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array($isbn));
    }
}

