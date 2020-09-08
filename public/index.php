<?php
require '../vendor/autoload.php';


//define('DEBUG_TIME', microtime());

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/* Refactoring du routage */
$router = new App\Router(dirname(__DIR__) . '/views');
$router->get('/blog', 'post/index', 'blog');
$router->get('/blog/category', 'category/show','category');
$router->run();

