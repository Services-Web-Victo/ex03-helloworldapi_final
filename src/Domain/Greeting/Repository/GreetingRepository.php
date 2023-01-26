<?php

namespace App\Domain\Greeting\Repository;

use PDO;

/**
 * Repository.
 */
class GreetingRepository
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
     * Sélectionne une salutation aléatoire parmi toutes les langues
     */
    public function selectGreetings(): array
    {
        $sql = "SELECT message, code FROM helloworld ORDER BY RAND() LIMIT 1;";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Sélectionne une salutation aléatoire selon un code de langue
     */
    public function selectGreetingsFromCode(string $codeLangue): array
    {
        $params = [
            'codeLangue' => $codeLangue,
        ];

        $sql = "SELECT message, code FROM helloworld WHERE code=:codeLangue ORDER BY RAND() LIMIT 1;";

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}

