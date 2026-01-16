<?php

include __DIR__ . "/../vendor/autoload.php";
use App\core\Router;
use App\controller\ContactController;
use App\controller\UserController;
use App\controller\LoginController;
use App\controller\{HomeController,AboutController};
$router = Router::getInstance();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);
$router->get('/register', [UserController::class, 'register']);
$router->post('/register', [UserController::class, 'register']);
$router->get('/delete/{id}', [UserController::class, 'delete']);
$router->get('/users', [UserController::class, 'all']); 
$router->dispatch();
?>