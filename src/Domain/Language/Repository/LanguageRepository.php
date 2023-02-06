<?php

namespace App\Domain\Language\Repository;

use PDO;

/**
 * Repository.
 */
class LanguageRepository
{
    /**
     * @var PDO La connexion à la base de données
     */
    private $connection;

    /**
     * Constructeur
     *
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Sélectionne toutes les langues disponibles
     */
    public function selectLanguages(): array
    {
        $sql = "SELECT l.code, l.langue FROM langages l ORDER BY l.code;";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Sélectionne une langue selon son code
     * 
     * @param int $codeLangue Le code de la langue
     * 
     * @return array Les informations sur la langue
     */
    public function selectLanguageFromCode(string $codeLangue): array 
    {

        $sql = "SELECT * FROM langages WHERE code = :code";
        $params = ["code" => $codeLangue];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}

