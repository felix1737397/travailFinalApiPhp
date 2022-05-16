<?php 

// Constante du mode de l'application
// dev : variables utilisées en local
// prod : pour le déploiement de l'api en production
define("MODE", "prod");

switch (MODE) {
    case "dev":
        // Configuration BD en local
        $_ENV['host'] = 'localhost';
        $_ENV['username'] = 'root';
        $_ENV['database'] = 'bibliotheque';
        $_ENV['password'] = 'mysql';
        break;

    case "prod":
        // Configuration BD pour Heroku
        $_ENV['host'] = 'us-cdbr-east-05.cleardb.net';
        $_ENV['username'] = 'bac7a4cffbd0a1';
        $_ENV['database'] = 'heroku_d41ae24f42fa539';
        $_ENV['password'] = '02e19a4d';
        break;
};