<?php
include __DIR__ . "/../vendor/autoload.php";
use App\core\Router;


$router = new Router();
$router -> get('/', function()
{
    echo "<h1>Welcome back</h1>";
});
$router -> get('/about', function()
{
    echo "<h1>About page </h1>";
});
$router -> get('/login', function()
{
    include __DIR__ . "/../views/login.php";
});
$router -> get('/404', function()
{
    http_response_code(404);
    echo "<h1>404 - Page non trouvée </h1>";
});
$router -> get("/user/{id}/{user}", function($id, $user)
{
    include __DIR__ . "/../views/user.php";
});
$router -> post("/add", function()
{
    echo "Donnes recus :";
    echo"<pre>";
    print_r($_POST);
    echo"<pre>";
});

$router -> dispatch();
?>