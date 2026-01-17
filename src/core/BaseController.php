<?php
namespace App\core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected $twig;
    protected $security;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $this->twig = new Environment($loader);
        $this->security = new Security();
        $this->session = Session::getInstance();
        $this->validation = new Validation();
        $this->twig->addGlobal('csrf_token', Security::generateCSRF());
    }

    protected function view(string $view, array $data = []): void
    {
        if (str_ends_with($view, '.twig')) {
            echo $this->twig->render($view, $data);
        } else {
            extract($data);
            $viewPath = __DIR__ . "/../../views/$view.php";
            if (file_exists($viewPath)) {
                require $viewPath;
            } else {
                echo "View not found: $view";
            }
        }
    }
}
