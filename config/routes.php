<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);
    $app->get('/livres', \App\Action\Livre\LivreViewAction::class);
    $app->post('/livres', \App\Action\Livre\LivreCreateAction::class);
    $app->delete('/livres/{isbn}', \App\Action\Livre\LivreDeleteAction::class);
    $app->put('/livres/{isbn}/{cleApi}', \App\Action\Livre\LivreUpdateAction::class);


    
    $app->options('/{routes:.*}', \App\Action\PreflightAction::class);

};
