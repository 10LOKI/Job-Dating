<?php
include __DIR__ . "/../vendor/autoload.php";
use App\core\Router;
use App\controller\HomeController;
use App\controller\AboutController;
use App\controller\ContactController;
use App\controller\UserController;

$router = Router::getInstance();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);
// $router->get('/user/{id}', [UserController::class, 'profile']);
$router->get('/delete/{id}', [UserController::class, 'delete']);
$router -> get('/users',[UserController::class, 'all']); 
$router->dispatch();
?>