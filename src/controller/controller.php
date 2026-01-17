<?php

namespace App\controller;

use App\core\Security;
use App\core\Session;
use App\core\Validator;
use App\core\View;

abstract class Controller
{

    protected $view;
    protected $security;
    protected $session;
    protected $validator;

    public function __construct()
    {
        $this->view = new View();
        $this->security = new Security();
        $this->session = Session::getInstance();
        $this->validator = new Validator();
    }


    protected function json(array $data, int $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect(string $url, int $statusCode = 302)
    {
        http_response_code($statusCode);
        header("Location: $url");
        exit;
    }


    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function verifyCsrf()
    {
        if (!$this->security->verifyCsrfToken($_POST['_token'] ?? '')) {
            $this->json(['error' => 'Invalid CSRF token'], 403);
            http_response_code(403);
        }
    }
}