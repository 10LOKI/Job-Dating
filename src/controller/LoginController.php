<?php
namespace App\controller;

use App\core\Security;
use App\core\Validation;

class LoginController extends Security  {
    
    public function index()
    {
        include __DIR__ . '/../../views/login.php';
    }
    
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $safeUsername = Security::clean($_POST['username']);
            $safeEmail = Security::clean($_POST['email']);
            echo "Username cleaned: " . $safeUsername . "<br>";
            echo "Email cleaned: " . $safeEmail;
        }
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submittedToken = $_POST['csrf_token'] ?? '';

            if (\App\Core\Security::verifyCSRF($submittedToken)) {
                echo "le token est validé";
            }
            else
            {
                http_response_code(403);
                die("CSRF token validation failed.");
            }
        }
    }
    public static function generateCSRF()
    {
        
        return parent::generateCSRF();
        
    }
    public static function validateEmail()
    {
        
    }  
}