<?php

namespace App\Domain\Greeting\Service;

use App\Domain\Greeting\Repository\GreetingRepository;
use App\Domain\Language\Repository\LanguageRepository;

final class GreetingCreate
{
    /**
     * @var GreetingRepository
     */
    private $repository;

    /**
     * @var LanguageRepositoryRepository
     */
    private $languageRepository;

    /**
     * The constructor.
     *
     * @param GreetingRepository $repository
     */
    public function __construct(GreetingRepository $repository, LanguageRepository $languageRepository)
    {
        $this->repository = $repository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * Ajoute une salutation.
     *
     * @param string $codeLangue Le code de la langue
     * @param string $message Le message à ajouter
     *
     * @return array La réponse à retourner à l'usager
     */
    public function addGreeting(string $codeLangue, string $message): array
    {

        $resultat = [];

        // Récupère le id de la langue selon le code
        $infoLangue = $this->languageRepository->selectLanguageFromCode($codeLangue);

        if(empty($infoLangue)) {
            $resultat = [
                "code" => null,
                "erreur" => "Le code de la langue est inexistant"
            ];
        } else {
            $idLangue = $infoLangue[0]['id'];
            $idGreeting = $this->repository->insertGreeting($idLangue, $message);
            $resultat = [
                "id" => $idGreeting,
                "code" => $codeLangue,
                "message" => $message
            ];
        }   

        return $resultat;
    }
}
