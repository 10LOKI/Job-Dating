<?php
namespace App\core;

class BaseController
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . "/../../views/$view.php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "View not found: $view";
        }
    }
}
