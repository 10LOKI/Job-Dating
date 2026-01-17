<?php

include __DIR__ . "/../vendor/autoload.php";
use App\core\Router;
//use App\controller\controller;
//use App\controller\ContactController;
//use App\controller\UserController;
//use App\controller\LoginController;
use App\controller\{HomeController,AboutController,ContactController,LoginController,UserController};
$router = Router::getInstance();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);
$router->get('/delete/{id}', [UserController::class, 'delete']);
$router->get('/users', [UserController::class, 'all']);
$router->get('/login', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
$router->get('/dashboard', [LoginController::class, 'dashboard']);
$router->get('/test', [LoginController::class, 'test']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->dispatch();
?>