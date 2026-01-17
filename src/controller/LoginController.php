<?php
namespace App\controller;

use App\core\BaseController;
use App\core\View;

class LoginController extends BaseController {
    
    public function index()
    {
        View::render('auth/login.twig', [
            'csrf_token' => $this->security::generateCSRF(),
            'error' => $this->session->flash('error')
        ]);
    }
    
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $submittedToken = $_POST['csrf_token'] ?? '';
            
            if (!$this->security::verifyCSRF($submittedToken)) {
                $this->session->flash('error', 'Invalid CSRF token');
                header('Location: /login');
                exit;
            }
            
            $email = $this->security::clean($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if ($this->validation::validateEmail($email) && !empty($password)) {
                // Simple test login (email: test@test.com, password: 123)
                if ($email === 'test@test.com' && $password === '123') {
                    $this->session->set('user_id', 1);
                    $this->session->set('email', $email);
                    $this->session->regenerate();
                    header('Location: /dashboard');
                    exit;
                } else {
                    $this->session->flash('error', 'Invalid credentials');
                }
            } else {
                $this->session->flash('error', 'Please fill all fields correctly');
            }
        }
        header('Location: /login');
        exit;
    }
    
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $submittedToken = $_POST['csrf_token'] ?? '';
            
            if (!$this->security::verifyCSRF($submittedToken)) {
                $this->session->flash('error', 'Invalid CSRF token');
                header('Location: /register');
                exit;
            }
            
            $email = $this->security::clean($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $username = $this->security::clean($_POST['username'] ?? '');
            
            if ($this->validation::validateEmail($email) && !empty($password) && !empty($username)) {
                $this->session->set('user_id', 2);
                $this->session->set('email', $email);
                $this->session->set('username', $username);
                $this->session->flash('success', 'Registration successful!');
                $this->session->regenerate();
                header('Location: /dashboard');
                exit;
            } else {
                $this->session->flash('error', 'Please fill all fields correctly');
            }
        }
        
        View::render('auth/register.twig', [
            'csrf_token' => $this->security::generateCSRF(),
            'error' => $this->session->flash('error')
        ]);
    }
    
    public function dashboard()
    {
        if (!$this->session->has('user_id')) {
            header('Location: /login');
            exit;
        }
        
        View::render('dashboard.twig', [
            'user' => [
                'id' => $this->session->get('user_id'),
                'email' => $this->session->get('email'),
                'username' => $this->session->get('username')
            ],
            'success' => $this->session->flash('success')
        ]);
    }
    
    public function logout()
    {
        $this->session->destroy();
        header('Location: /login');
        exit;
    }
}