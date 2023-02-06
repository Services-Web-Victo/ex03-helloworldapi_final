<?php

namespace App\Action;

use App\Domain\Greeting\Service\GreetingCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GreetingCreateAction
{
    private $greetingCreate;

    public function __construct(GreetingCreate $greetingCreate)
    {
        $this->greetingCreate = $greetingCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();
        // Récupération de la valeur de titre
        $codeLangue = $data['code'] ?? '';
        $message = $data['message'] ?? '';

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->greetingCreate->addGreeting($codeLangue, $message);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
