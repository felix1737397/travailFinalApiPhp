<?php

namespace App\Domain\Livre\Repository;

use PDO;
/**
 * Repository.
 */
class LivreUpdatorRepository
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
     * Insert livre row.
     *
     * @param array $livre The livre
     *
     * @return int The new ID
     */
    public function updateLivre(array $livre, int $isbn): bool
    {
        
        $sql = "SELECT * FROM livre WHERE isbn =?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array($isbn));
        if ( $stmt->rowCount()!=null) {
            $row = [
                'prenom_auteur' => $livre['prenom_auteur'],
                'nom_famille_auteur' => $livre['nom_famille_auteur'],
                'titre' => $livre['titre'],
                'nb_page' => $livre['nb_page'],
                'isbn' => $livre['isbn'],
                'date_publication' => $livre['date_publication'],
                'langue' => $livre['langue'],
                'collection' => $livre['collection'],
                'tome' => $livre['tome'],
                'image' => $livre['image'],
            ];
    
            $sql = "UPDATE livre SET 
                    prenom_auteur=:prenom_auteur, 
                    nom_famille_auteur=:nom_famille_auteur, 
                    titre=:titre, 
                    nb_page=:nb_page, 
                    isbn=:isbn, 
                    date_publication=:date_publication, 
                    langue=:langue, 
                    collection=:collection,
                    tome=:tome, 
                    image=:image WHERE isbn=:isbn";
            $query = $this->connection->prepare($sql);
            $query->execute($row);
            return true; 
        } else {
            $row = [
                'prenom_auteur' => $livre['prenom_auteur'],
                'nom_famille_auteur' => $livre['nom_famille_auteur'],
                'titre' => $livre['titre'],
                'nb_page' => $livre['nb_page'],
                'isbn' => $livre['isbn'],
                'date_publication' => $livre['date_publication'],
                'langue' => $livre['langue'],
                'collection' => $livre['collection'],
                'tome' => $livre['tome'],
                'image' => $livre['image'],
            ];
            $sql = "INSERT INTO livre (prenom_auteur, nom_famille_auteur, titre, nb_page, isbn, date_publication, langue, collection, tome, image) VALUES 
            (:prenom_auteur, :nom_famille_auteur, :titre, :nb_page, :isbn, :date_publication, :langue, :collection, :tome, :image);";
            $this->connection->prepare($sql)->execute($row);
            return false;
        }
    }
}

