<?php
require '../vendor/autoload.php';

$router = new AltoRouter();

// creation d'une constante VIEW_PATH
define('VIEW_PATH', dirname(__DIR__) . '/views');

// mise en place des routes 
$router->map('GET', '/blog', function () {
    require VIEW_PATH . '/post/index.php';
});

$router->map('GET', '/blog/category', function () {
    require VIEW_PATH . '/category/show.php';
});

// verification de la correspondance url tapé et routes
$match = $router->match();
$match['target']();
