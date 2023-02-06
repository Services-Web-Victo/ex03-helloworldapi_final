<?php

namespace App\Action;

use App\Domain\Greeting\Service\GreetingView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GreetingAction
{
    private $greetingView;

    public function __construct(GreetingView $greetingView)
    {
        $this->greetingView = $greetingView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des paramètres dans un tableau
        // S'il n'y a pas de paramètre, retourne un tableau vide
        $queryParams = $request->getQueryParams() ?? [];
        // Récupération de la valeur du paramètre page
        $codeLangue = $queryParams['language'] ?? "";

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->greetingView->selectRandomGreeting($codeLangue);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
