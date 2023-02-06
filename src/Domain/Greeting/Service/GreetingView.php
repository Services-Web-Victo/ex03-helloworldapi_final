<?php

namespace App\Domain\Greeting\Service;

use App\Domain\Greeting\Repository\GreetingRepository;

/**
 * Service.
 */
final class GreetingView
{
    /**
     * @var GreetingRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param GreetingRepository $repository
     */
    public function __construct(GreetingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne une salutation aléatoire.
     *
     * @param string $codeLangue Le code de la langue
     *
     * @return string La salutation
     */
    public function selectRandomGreeting(string $codeLangue): array
    {

        if ($codeLangue == "") {
            // Sélectionne une salutation parmi toutes les langues
            $salutation = $this->repository->selectGreetings();
        } else {
            // Sélectionne une salutation parmi la langue demandée
            $salutation = $this->repository->selectGreetingsFromCode($codeLangue);
        }

        // Tableau qui contient la réponse à retourner à l'usager
        $resultat = [
            "code" => $salutation[0]['code'] ?? "",
            "message" => $salutation[0]['message'] ?? "Aucune salutation trouvée"
        ];


        return $resultat;
    }


}
