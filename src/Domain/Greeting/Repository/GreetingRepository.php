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
        $sql = "
            SELECT s.message, l.code 
            FROM salutations s INNER JOIN langages l ON l.id = s.langue_id 
            ORDER BY RAND() LIMIT 1;
        ";

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

        $sql = "
            SELECT s.message, l.code 
            FROM salutations s INNER JOIN langages l ON l.id = s.langue_id 
            WHERE l.code=:codeLangue
            ORDER BY RAND() LIMIT 1;
        ";

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Ajoute un message de salutation
     * 
     * @param int $langueId Le id du code de langue 
     * @param string $message Le message à ajouter
     *
     * @return int Le id du message ajouté
     */
    public function insertGreeting(int $langueId, string $message): int
    {
        $row = [
            'langue_id' => $langueId,
            'message' => $message
        ];

        $sql = "INSERT INTO salutations SET 
                langue_id=:langue_id, 
                message=:message";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

}

