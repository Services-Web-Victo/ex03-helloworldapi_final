<?php

namespace App\Action;

use App\Domain\Language\Service\LanguageView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LanguageAction
{
    private $languageView;

    public function __construct(LanguageView $languageView)
    {
        $this->languageView = $languageView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->languageView->selectAllLanguage();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
