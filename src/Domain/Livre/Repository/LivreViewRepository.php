<?php

namespace App\Domain\Livre\Repository;

use PDO;

/**
 * Repository.
 */
class LivreViewRepository
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
    
    public function selectAllLivre(): array
    {
        if($_REQUEST['auteur'] != ""){
            $params = [ "auteur" => $_REQUEST['auteur']];
            $sql = "SELECT * FROM livre WHERE nom_famille_auteur = :auteur ORDER BY collection, nom_famille_auteur, prenom_auteur, tome";
            $query = $this->connection->prepare($sql);
            $query->execute($params);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        if($_REQUEST['id_livre'] != ""){
            $params = [ "id_livre" => $_REQUEST['id_livre']];
            $sql = "SELECT * FROM livre WHERE id_livre = :id_livre";
            $query = $this->connection->prepare($sql);
            $query->execute($params);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        if($_REQUEST['isbn'] != ""){
            $params = [ "isbn" => $_REQUEST['isbn']];
            $sql = "SELECT * FROM livre WHERE isbn = :isbn LIMIT 1";
            $query = $this->connection->prepare($sql);
            $query->execute($params);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        $sql = "SELECT * FROM livre ORDER BY collection, nom_famille_auteur, prenom_auteur, tome";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
      /**
     * Insert livre row.
     *
     * @param array $livre The livre
     *
     * @return int The new ID
     */
    public function insertLivre(array $livre): int
    {
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

        $sql = "INSERT INTO livre SET 
                prenom_auteur=:prenom_auteur, 
                nom_famille_auteur=:nom_famille_auteur, 
                titre=:titre, 
                nb_page=:nb_page, 
                isbn=:isbn, 
                date_publication=:date_publication, 
                langue=:langue, 
                collection=:collection,
                tome=:tome, 
                image=:image;";
        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}

