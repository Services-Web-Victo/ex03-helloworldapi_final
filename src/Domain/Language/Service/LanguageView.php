<?php

namespace App\Domain\Language\Service;

use App\Domain\Language\Repository\LanguageRepository;

/**
 * Service.
 */
final class LanguageView
{
    /**
     * @var LanguageRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LanguageRepository $repository
     */
    public function __construct(LanguageRepository $repository)
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
    public function selectAllLanguage(): array
    {

        $languages = $this->repository->selectLanguages();

        // Tableau qui contient la réponse à retourner à l'usager
        $resultat = [
            "langues" => $languages ?? [],
            "total" => count($languages)
        ];

        return $resultat;
    }


}
