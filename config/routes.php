<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->get('/greetings', \App\Action\GreetingAction::class);
    $app->post('/greetings', \App\Action\GreetingCreateAction::class);

    $app->get('/languages', \App\Action\LanguageAction::class);



};

