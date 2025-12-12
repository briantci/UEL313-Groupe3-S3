<?php

// Activer le buffering pour éviter les erreurs de "headers already sent"
ob_start();

// Supprimer l'affichage des avertissements de dépréciation avant les headers
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../app/config/dev.php';
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/routes.php';

// Mode debug : activé SAUF pour /rss (évite les erreurs de session pour RSS)
$isRssRequest = (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/rss') !== false);
$app['debug'] = !$isRssRequest;

$app->run();